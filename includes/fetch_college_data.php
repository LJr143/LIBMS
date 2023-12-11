
<?php
require_once 'C:\wamp64\www\LIBMS\db_config\config.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

class CollegeData
{
    protected $database;

    public function __construct($database)
    {
        $this->database = $database->getDb();
    }

    public function getAllCollege(): array
    {
        $sql = "SELECT * FROM tbl_college";
        $stmt = $this->database->query($sql);

        if ($stmt) {
            $colleges = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $colleges;
        } else {
            return array();
        }
    }

    public function getNumberOfColleges(): int
    {
        $sql = "SELECT COUNT(*) as num_colleges FROM tbl_college";
        $stmt = $this->database->prepare($sql);

        if ($stmt->execute()) {
            return (int)$stmt->fetch(PDO::FETCH_ASSOC)['num_colleges'];
        } else {
            return 0;
        }
    }

    public function getCollegeById($collegeId): array
    {
        $sql = "SELECT * FROM tbl_college WHERE college_id = :collegeId";
        $stmt = $this->database->prepare($sql);
        $stmt->bindParam(':collegeId', $collegeId, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $errorInfo = $stmt->errorInfo();
            if ($errorInfo[0] !== '00000') {
                // Log or print the error information
                error_log("Database error: " . $errorInfo[2]);
            }

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return array();
        }
    }

    public function addCollege($collegeId, $collegeName): array
    {
        $sql = "INSERT INTO tbl_college (college_id, college_name)
            VALUES (:college_id, :college_name)";
        $stmt = $this->database->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':college_id', $collegeId, PDO::PARAM_STR);
        $stmt->bindParam(':college_name', $collegeName, PDO::PARAM_STR);

        // Execute the query
        $success = $stmt->execute();

        // Return an array with success information
        return [
            'success' => $success,
            'message' => $success ? 'College added successfully' : 'Failed to add college',
        ];
    }
    public function updateCollege($collegeId, $collegeName): array
    {
        $sql = "UPDATE tbl_college SET college_name = :college_name WHERE college_id = :college_id";
        $stmt = $this->database->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':college_id', $collegeId, PDO::PARAM_STR);
        $stmt->bindParam(':college_name', $collegeName, PDO::PARAM_STR);

        // Execute the query
        $success = $stmt->execute();

        // Return an array with success information
        return [
            'success' => $success,
            'message' => $success ? 'College updates successfully' : 'Failed to update college',
        ];
    }

    public function deleteCollege($collegeId){
        $sql = "DELETE FROM tbl_college WHERE college_id = :college_ID";

        $stmt = $this->database->prepare($sql);
        $stmt->bindParam(':college_ID', $collegeId, PDO::PARAM_STR);

        return $stmt->execute();
    }


}
class CourseData extends CollegeData
{

    public function getAllCourses(): array
    {
        $sql = "SELECT * FROM tbl_course";
        $stmt = $this->database->query($sql);

        if ($stmt) {
            $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $courses;
        } else {
            return array();
        }
    }

    public function addCourse($collegeId, $courseName): array
    {
        $sql = "INSERT INTO tbl_course (college_id, course_name)
            VALUES (:college_id, :course_name)";
        $stmt = $this->database->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':college_id', $collegeId, PDO::PARAM_STR);
        $stmt->bindParam(':course_name', $courseName, PDO::PARAM_STR);

        // Execute the query
        $success = $stmt->execute();

        // Return an array with success information
        return [
            'success' => $success,
            'message' => $success ? 'Course added successfully' : 'Failed to add course',
        ];
    }


}


