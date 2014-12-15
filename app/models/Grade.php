<?php

class Grade extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'grades';
	/*
	This function will gets all grades and return list of grades
	*/
	
	public static function getGrades(){
		#Fetching all the students from students table and showing 
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
