# Core Package

### FILTERS - SELECT PARTICULAR FIELDS
**K** is keys, **R** is relation 
{
  "k": [
    "id",
    "firstName",
    "lastName",
    "code",
    "phoneNumber",
    "userId",
    "designationId",
    "dateOfJoining",
    "departmentEnvId"
  ],
  "r": {
    "designation": {
      "k": [
        "id",
        "name",
        "departmentId"
      ],
      "r": {
        "department": {
          "k": [
            "id",
            "name"
          ],
          "r": null
        }
      }
    },
    "salaryBreakups": {
      "k": [
        "id"
      ],
      "r": null
    },
    "salaryBreakup": {
      "k": [],
      "r": null
    }
  }
}

