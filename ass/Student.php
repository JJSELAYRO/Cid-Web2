<?php
class Student {
    private $studentID;
    private $fullName;
    private $course;
    private $yearLevel;

    public function __construct($studentID, $fullName, $course, $yearLevel) {
        $this->studentID = $studentID;
        $this->fullName = $fullName;
        $this->course = $course;
        $this->yearLevel = $yearLevel;
    }

    // Getter methods
    public function getStudentID() {
        return $this->studentID;
    }

    public function getFullName() {
        return $this->fullName;
    }

    public function getCourse() {
        return $this->course;
    }

    public function getYearLevel() {
        return $this->yearLevel;
    }

    // Setter methods with validation
    public function setStudentID($studentID) {
        if (preg_match('/^\d{4}-\d{3}$/', $studentID)) {
            $this->studentID = $studentID;
            return true;
        }
        return false;
    }

    public function setFullName($fullName) {
        if (!empty(trim($fullName))) {
            $this->fullName = trim($fullName);
            return true;
        }
        return false;
    }

    public function setCourse($course) {
        if (!empty(trim($course))) {
            $this->course = trim($course);
            return true;
        }
        return false;
    }

    public function setYearLevel($yearLevel) {
        if (is_numeric($yearLevel) && $yearLevel >= 1 && $yearLevel <= 4) {
            $this->yearLevel = $yearLevel;
            return true;
        }
        return false;
    }
}
?>