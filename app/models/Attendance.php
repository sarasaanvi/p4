<?php

class Attendance extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'attendances';
	// Disabling use of "created_at" and "updated_at" columns:
	public $timestamps = false;
	
	public function student() {
        # Attendance belongs to Student
        # Define an inverse one-to-many relationship.
        return $this->belongsTo('Student');
    }
	
	#Get today's Attendance summary
	public static function getAttendanceList($grade_id, $date,$teacher_id){
		#Today summary for specific grade 
		$Attendances =Attendance::where('grade_id','=',$grade_id)
			->where('attendance_date', '=', $date)
			->where('teacher_id', '=', $teacher_id)
			->groupBy('student_id')
			->get(array('id', 'student_id', 'attended', 'attendance_date'));		
			
		if($Attendances->isEmpty() != TRUE) {	
			return $Attendances;
		}
	}
	
	
	#Get today's Attendance summary
	public static function getClassAttendance($grade_id, $date, $teacher_id){
		#Today summary for specific grade 
		$Attendances =Attendance::where('grade_id','=',$grade_id)
			->where('attendance_date', '=', $date)
			->where('teacher_id', '=', $teacher_id)
			->groupBy('student_id')
			->get(array('id', 'student_id', 'attended', 'attendance_date', 'grade_id'));		
			
		$totalStudents = Student::getClass($grade_id);	
		if($Attendances->isEmpty() != TRUE) {
			$present = 0;
			$absent = 0;
			$total = count($totalStudents);			
			foreach($Attendances as $Attendance){
				if ($Attendance->attended == 1){
					$present = $present +1;
				}else{
					$absent = $absent +1;
				}				
			}
			return array($total ,$present, $absent) ;
		} else {
			return "Not Found";
		}
		// return $roll;
		// $student =Attendance::where('grade_id','=',$grade_id)->count();
	}

}
