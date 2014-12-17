<?php


class Mark extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	// Disabling use of "created_at" and "updated_at" columns:
	public $timestamps = false;
	
	protected $table = 'marks';
	public function student() {
        # Marks belongs to Student
        # Define an inverse one-to-many relationship.
        return $this->belongsTo('Student');
    }
	
	public function exam() {
        # Mark belongs to Exam
        # Define an inverse one-to-many relationship.
        return $this->belongsTo('Exam');
    }
	
	public function teacher() {
        # Mark Added by  Teacher so Marks belong to Teacher as well 
        # Define an inverse one-to-many relationship.
        return $this->belongsTo('Teacher');
    }
	 
	public static function getMarksExams($exam_id) {
		$marks =Mark::where('exam_id','=',$exam_id)
				->with('student','exam')
				->get();
		if($marks->isEmpty() != TRUE) {
			foreach($marks as $mark) {
				echo $mark->student->first_name;
				echo $mark->exam->exam;
				echo $mark->subject;
				echo "<br>";
			}
		}
    }
	

}
