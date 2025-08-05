<?php
require_once 'Student.php';
require_once 'database.php';

class StudentManager {
    private $db;
    private $conn;

    public function __construct() {
        $this->db = new Database();
        $this->conn = $this->db->getConnection();
        $this->db->createTable();
    }

    public function addStudent($student) {
        $query = "INSERT INTO students (student_id, full_name, course, year_level) 
                  VALUES (:student_id, :full_name, :course, :year_level)";
        
        try {
            $stmt = $this->conn->prepare($query);
            
            $studentID = $student->getStudentID();
            $fullName = $student->getFullName();
            $course = $student->getCourse();
            $yearLevel = $student->getYearLevel();
            
            $stmt->bindParam(':student_id', $studentID);
            $stmt->bindParam(':full_name', $fullName);
            $stmt->bindParam(':course', $course);
            $stmt->bindParam(':year_level', $yearLevel);
            
            return $stmt->execute();
        } catch(PDOException $e) {
            error_log("Error adding student: " . $e->getMessage());
            return false;
        }
    }

    public function listStudents() {
        $query = "SELECT * FROM students ORDER BY created_at DESC";
        
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            error_log("Error listing students: " . $e->getMessage());
            return [];
        }
    }

    public function findStudentByID($studentID) {
        $query = "SELECT * FROM students WHERE student_id = :student_id";
        
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':student_id', $studentID);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            error_log("Error finding student: " . $e->getMessage());
            return null;
        }
    }
}
?>