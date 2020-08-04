<?php


namespace App\Services;


use Box\Spout\Common\Type;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Writer\Common\Creator\WriterFactory;

class UtilityService
{

    public static function recurseAndIncrementParentCount($data, $relation, &$count = 0)
    {
        if ($data->{$relation}) {
            ++$count;
            UtilityService::recurseAndIncrementParentCount($data->{$relation},$relation, $count);
        }
    }

    public static function createSpoutFile($data, $headers, $filePath, $fileType = 'XLSX', $title = null)
    {
        array_unshift($data, $headers);

        switch ($fileType) {
            case 'CSV':
            case 'csv':
                $fileType = Type::CSV;
                break;
            default:
                $fileType = Type::XLSX;
        }

        $writer = WriterFactory::createFromType($fileType);

        $writer->openToFile($filePath);
        foreach ($data as $values) {
            if (is_array($values)) {
                $rowFromValues = WriterEntityFactory::createRowFromArray($values);
            } else {
                $rowFromValues = WriterEntityFactory::createRowFromArray([$values]);
            }
            $writer->addRow($rowFromValues);
        }
        if ($fileType === Type::XLSX && $title) {
            $sheet = $writer->getCurrentSheet();
            $sheet->setName($title);
        }

        $writer->close();
    }

    public static function toAlphabet($num)
    {

        $numeric = $num % 26;
        $letter = chr(65 + $numeric);
        $num2 = intval($num / 26);
        if ($num2 > 0) {
            return self::toAlphabet($num2 - 1) . $letter;
        } else {
            return $letter;
        }

    }

}
