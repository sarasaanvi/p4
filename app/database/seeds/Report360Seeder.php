<?php
class Report360Seeder extends Seeder {
	public function run() {
		# Clear the tables to a blank slate
		DB::statement('SET FOREIGN_KEY_CHECKS=0'); # Disable FK constraints so that all rows can be deleted, even if there's an associated FK
		DB::statement('TRUNCATE users');
		DB::statement('TRUNCATE students');
		DB::statement('TRUNCATE teachers');
		DB::statement('TRUNCATE marks');
		DB::statement('TRUNCATE grades');
		DB::statement('TRUNCATE exams');
		DB::statement('TRUNCATE extracurriculars');
		DB::statement('TRUNCATE attendances');
		DB::statement('TRUNCATE teacher_grade');
	
		
		#user tables
		# Adding student id =1
		$studentUsr = new User;
		$studentUsr->user_name = 'S1';
		$studentUsr->account_type = 'Student';
		$studentUsr->password = Hash::make('abc123');
		$studentUsr->sign_up = true;
		$studentUsr->save();
		# Adding student id =2
		$studentUsr = new User;
		$studentUsr->user_name = 'S2';
		$studentUsr->account_type = 'Student';
		$studentUsr->password = Hash::make('abc123');
		$studentUsr->sign_up = true;
		$studentUsr->save();
		
		# Adding teacher id =2
		$teacherUsr = new User;
		$teacherUsr->user_name = "T1";
		$teacherUsr->account_type = 'Teacher';
		$teacherUsr->password = Hash::make('abc123');
		$teacherUsr->sign_up = true;
		$teacherUsr->save();
		
		# Adding Admin id =3
		$teacherUsr = new User;
		$teacherUsr->user_name = 'a1';
		$teacherUsr->account_type = 'Admin';
		$teacherUsr->password = Hash::make('abc123');
		$teacherUsr->sign_up = true;
		$teacherUsr->save();
		
 		#Adding Teacher
		$teacher = new Teacher;
		$teacher->first_name = 'Philip';
		$teacher->last_name = 'Brown';
		$teacher->dob = '1932-10-27';
		$teacher->email = 'philip.brown@gmail.com';
		$teacher->phone = '9086087511';
		$teacher->address = 'Apt 04, Gales Drive';
		$teacher->city = 'New Providence';
		$teacher->state = 'New Jersey';
		$teacher->zip = '07974';
		$teacher->photo_path = '/imgData/teachers/1.jpg';
		$teacher->user_name = "T1"; 
		$teacher->timestamps = false;
		$teacher->save();
		
		
 		#Adding grades by default each grade sections- 'A' 
		for ($i=1;$i<=12;$i++){
			$grade = new Grade;
			$grade->grade = $i;
			$grade->section = 'A';
			$grade->timestamps = false;
			$grade->save();
		} 
		
		
	#Adding student
		$student = new Student;
		$student->roll = 1;
		$student->first_name = 'Abhinav';
		$student->last_name = 'Saxena';
		$student->dob = '1982-04-30';
		$student->email = 'abhinav_the1@gmail.com';
		$student->phone = '9086087511';
		$student->address = 'Apt 04, Gales Drive';
		$student->city = 'New Providence';
		$student->state = 'New Jersey';
		$student->zip = '07974';
		$student->photo_path = '/imgData/students/1.jpg';
		$student->grade_id = 9;
		$student->user_name = 'S1';
		
		$student->save();
		
		#Adding student
		$student = new Student;
		$student->roll = 2;
		$student->first_name = 'Hemadris';
		$student->last_name = 'Saxena';
		$student->dob = '1982-04-30';
		$student->email = 'hemadri.saxena@gmail.com';
		$student->phone = '9086087511';
		$student->address = 'Apt 04, Gales Drive';
		$student->city = 'New Providence';
		$student->state = 'New Jersey';
		$student->zip = '07974';
		$student->photo_path = '/imgData/students/2.jpg';
		$student->grade_id = 9;
		$student->user_name = 'S2';
		
		$student->save();
		
		
	}
}