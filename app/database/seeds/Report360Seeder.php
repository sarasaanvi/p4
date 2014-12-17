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
		DB::statement('TRUNCATE grade_teacher');
	
		
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
	
	#Adding grades by default each grade sections- 'A' 
		for ($i=1;$i<=12;$i++){
			$grade = new Grade;
			$grade->grade = $i;
			$grade->section = 'A';
			$grade->timestamps = false;
			$grade->save();
		} 
		
	#Adding Exams  
		$exam = new Exam;
		$exam->exam = "Exam 1";
		$exam->full_marks = 100;
		$exam->passing_marks =70;
		$exam->save();
		
		$exam = new Exam;
		$exam->exam = "Exam 2";
		$exam->full_marks = 50;
		$exam->passing_marks =30;
		$exam->save();
		
		$exam = new Exam;
		$exam->exam = "Exam 3";
		$exam->full_marks = 23;
		$exam->passing_marks =15;
		$exam->save();
		
		$exam = new Exam;
		$exam->exam = "Quiz";
		$exam->full_marks = 25;
		$exam->passing_marks =15;
		$exam->save();
		
		$exam = new Exam;
		$exam->exam = "Assignments";
		$exam->full_marks = 100;
		$exam->passing_marks =60;
		$exam->save();
		 


	
 	#Adding Teacher
		$teacher = new Teacher;
		$teacher->first_name = 'Skyler';
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
		
		#Adding Grades belong to this teacher (adding row in Teacher-Grade table)
		# This enters a new row in the book_tag table
		$grades = array(9,10);
		foreach ($grades as $grade) {
			$teacher->grades()->save(Grade::find($grade));
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
		
		
	#Adding Attendance for student id 1
		$date = '2014-12-01'; # YYYY-MM-DD
		for ($i=1;$i<=12;$i++){
			$attendance = new Attendance;
			$attendance->student_id = 1;
			$attendance->grade_id = 9;
			$attendance->teacher_id = 1;			
			$val = rand(0, 1);
			$attendance->attended =  $val;
			$attendance->attendance_date = $date ;
			$attendance->timestamps = false;
			#next date
			$date1 = str_replace('-', '/', $date);
			$date = date('Y-m-d',strtotime($date1 . "+1 days"));
			$attendance->save();
		} 
		
	#Adding marks for Student 1
		$mark = new Mark;
		$mark->subject = "Subject1";
		$mark->exam_date = '2014-12-01';
		$mark->mark_obtained = 90;
		$mark->teacher_id = 1;
		$mark->student_id = 1;
		$mark->exam_id = 1;		
		$mark->save();
		
		$mark = new Mark;
		$mark->subject = "Subject2";
		$mark->exam_date = '2014-12-01';
		$mark->mark_obtained = 76;
		$mark->teacher_id = 1;
		$mark->student_id = 1;
		$mark->exam_id = 1;		
		$mark->save();
		
		$mark = new Mark;
		$mark->subject = "Subject1";
		$mark->exam_date = '2014-11-01';
		$mark->mark_obtained = 34;
		$mark->teacher_id = 1;
		$mark->student_id = 1;		
		$mark->exam_id = 4;
		$mark->save();
		
		$mark = new Mark;
		$mark->subject = "Subject2";
		$mark->exam_date = '2014-11-01';
		$mark->mark_obtained = 69;
		$mark->teacher_id = 1;
		$mark->student_id = 1;
		$mark->exam_id = 4;		
		$mark->save();
		
	
		
		
	#Adding student with ID 2
		$student = new Student;
		$student->roll = 2;
		$student->first_name = 'Hemadri';
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
		
	#Adding Attendance for student id 2
		$date = '2014-12-01'; # YYYY-MM-DD
		for ($i=1;$i<=12;$i++){
			$attendance = new Attendance;
			$attendance->student_id = 2;
			$attendance->grade_id = 9;
			$attendance->teacher_id = 1;			
			$val = rand(0, 1);
			//echo $val;
			$attendance->attended =  $val;
			//echo $date;
			$attendance->attendance_date = $date ;
			$attendance->timestamps = false;
			#next date
			$date1 = str_replace('-', '/', $date);
			$date = date('Y-m-d',strtotime($date1 . "+1 days"));
			$attendance->save();
		} 
	
	#Adding marks for Student 2
		$mark = new Mark;
		$mark->subject = "Subject1";
		$mark->exam_date = '2014-12-01';
		$mark->mark_obtained = 70;
		$mark->teacher_id = 1;
		$mark->student_id = 2;
		$mark->exam_id = 1;		
		$mark->save();
		
		$mark = new Mark;
		$mark->subject = "Subject2";
		$mark->exam_date = '2014-12-01';
		$mark->mark_obtained = 98;
		$mark->teacher_id = 1;
		$mark->student_id = 2;
		$mark->exam_id = 1;		
		$mark->save();
		
		$mark = new Mark;
		$mark->subject = "Subject1";
		$mark->exam_date = '2014-11-01';
		$mark->mark_obtained = 88;
		$mark->teacher_id = 1;
		$mark->student_id = 2;
		$mark->exam_id = 4;		
		$mark->save();
		
		$mark = new Mark;
		$mark->subject = "Subject2";
		$mark->exam_date = '2014-11-01';
		$mark->mark_obtained = 77;
		$mark->teacher_id = 1;
		$mark->student_id = 2;
		$mark->exam_id = 4;
		$mark->save();
	
	} #function end
} #class end