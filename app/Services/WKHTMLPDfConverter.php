<?php
/**
 * Created by JetBrains PhpStorm.
 * User: keshav
 * Date: 10/10/13
 * Time: 3:02 PM
 * To change this template use File | Settings | File Templates.
 */

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Spatie\Browsershot\Browsershot;

class WKHTMLPDfConverter
{

    private $location;
    public $output_file_path;
    public $html;
    public $margin_horizontal;
    public $margin_vertical;
    public $header = true;
    public $footer;
    public $dpi;
    public $orientation;

    private $header_footer_font;
    private $header_footer_font_size;
    private $header_footer_spacing;


    public function __construct()
    {


        $this->dpi = 200;
        $this->margin_horizontal = 10;
        $this->margin_vertical = 15;
        $this->orientation = 'Portrait';
        $this->footer = "";
        $this->header_footer_font = "open sans";
        $this->header_footer_font_size = "7";
        $this->header_footer_spacing = "5";
    }

    public function convert($html, $pdfFileName = null)
    {

        if ($this->header)
            $this->header = "Page [page] of [toPage]";
        $this->location = config('file.wkhtml_path');
        try {
            $tmp_path = config('file.pdf_directory') . Carbon::now()->timestamp . '.html';

            $fp = fopen($tmp_path, "w+");
            fclose($fp);
            File::put($tmp_path, $html);

            $html_path = "file:///" . $tmp_path;

            $filePath = config('file.pdf_directory') . $pdfFileName ?? Carbon::now()->timestamp . '.pdf';
            $cmd = $this->location
                . " --margin-left $this->margin_horizontal --margin-right $this->margin_horizontal --margin-top $this->margin_vertical --margin-bottom $this->margin_vertical"
                . " --dpi $this->dpi --orientation $this->orientation"
                . " --footer-center \"$this->footer\" --header-right \"$this->header\" --header-font-name \"$this->header_footer_font\" --footer-font-name \"$this->header_footer_font\" "
                . " --footer-font-size $this->header_footer_font_size --header-font-size $this->header_footer_font_size --footer-spacing $this->header_footer_spacing --header-spacing $this->header_footer_spacing"
                . " \"$html_path\" \"$filePath\"";

            $command = $cmd . ' ';
            Log::info($cmd);
            $pid = exec($command, $output);
            sleep(2);
            return array('processId' => $pid, 'filePath' => $filePath, 'htmlPath' => $tmp_path, 'fileName' => $pdfFileName);
        } catch (\Exception $e) {
            Log::error($e);
            throw $e;
        }
    }

    public function convertBrowserShot($html, $pdfFileName = null, $format = 'A3')
    {
        if ($this->header)
            $this->header = "Page [page] of [toPage]";

        try {
            $tmp_path = config('file.pdf_directory') . Carbon::now()->timestamp . '.html';
            $fp = fopen($tmp_path, "w+");

            fclose($fp);
            File::put($tmp_path, $html);

            $filePath = config('file.pdf_directory') . $pdfFileName ?? Carbon::now()->timestamp . '.pdf';

            Browsershot::html(File::get($tmp_path))
                ->timeout(600)
                ->showBackground()
                ->format($format)
                ->save($filePath);

            return array('processId' => 1, 'filePath' => $filePath,
                'htmlPath' => $tmp_path, 'fileName' => $pdfFileName);
        } catch (\Exception $e) {
            Log::error($e);
            throw $e;
        }
    }

    public static function convertChromeShot($html, $pdfFileName = null, $format = 'A3')
    {
        try {
            $tmp_path = config('file.pdf_directory') . Carbon::now()->timestamp . '.html';
            $fp = fopen($tmp_path, "w+");

            fclose($fp);
            File::put($tmp_path, $html);

            $filePath = config('file.pdf_directory') . $pdfFileName ?? Carbon::now()->timestamp . '.pdf';

            exec('node ' . base_path('node_modules/chromeshot/index.js') . ' "{\"url\": \"file://' . $tmp_path . '\", \"options\": {\"path\": \"' . $filePath . '\"}}"');

            return array('processId' => 1, 'filePath' => $filePath,
                'htmlPath' => $tmp_path, 'fileName' => $pdfFileName);
        } catch (\Exception $e) {
            Log::error($e);
            throw $e;
        }
    }

}
