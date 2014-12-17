<?php

class Grade extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	# The guarded properties specifies which attributes should *not* be mass-assignable
    protected $guarded = array('id', 'created_at', 'updated_at'); 
	
	protected $table = 'grades';
	
	// Disabling use of "created_at" and "updated_at" columns:
	public $timestamps = false;
	
	/*
	This function will gets all grades and return list of grades
	*/	
	public function teachers() {
        # Grades belong to many Teachers
        return $this->belongsToMany('Teacher');
    }
	
	public static function getGrades(){
		#Fetching all the Grades 
		$grades =Grade::all();
		$gradeList = Array();
		foreach($grades as $grade){
			$gradeList[$grade->id] = $grade->grade;
		}
		#Removing an duplicate entry
		$gradeList = array_unique($gradeList);
		return $gradeList;
		
	}
	
	
	
	
	
	/*
	This function will gets all Sections for each Grade and return list of section for each Grade
	*/
	public static function getsections() {
	
	}
}
