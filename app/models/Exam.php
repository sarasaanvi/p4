<?php


class Exam extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'exams';
	
	public function mark() {
        # Exam has many Marks
        # Define a one-to-many relationship.
        return $this->hasMany('Mark');
    }
	
	// Disabling use of "created_at" and "updated_at" columns:
	public $timestamps = false;
	# The guarded properties specifies which attributes should *not* be mass-assignable
    protected $guarded = array('id', 'created_at', 'updated_at'); 
	
	public static function getExamList(){
		#Fetching all the students from students table and showing 
		$exams =Exam::all(array('id','exam'));
		$ExamList = array();
		if($exams->isEmpty() != TRUE) {
			foreach($exams as $exam) {
				 $ExamList[$exam->id] = $exam->exam;
			}
		}
		return $ExamList;		
	}
	
	public static function getIdForExam($exam){
		#Fetching all the students from students table and showing 
		$exam =Exam::where('exam', '=', $exam)
				->first(array('id','exam'));
		$exam_id = $exam->id;
		return $exam_id;		
	}
	

}
