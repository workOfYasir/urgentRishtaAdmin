<?php

use Illuminate\Support\Facades\Auth;

Route::group(['prefix' => '/v1', 'namespace' => 'Api\V1', 'as' => 'api.'], function () {

});
Route::get('/test', function(){
    return Auth::user();
});
Route::post('/login', 'Auth\LoginController@loginApi');
Route::post('/register', 'Auth\RegisterController@registerApi');

Route::group([
    'middleware' => ['auth:api', 'role:trainer' ]
],
    function () { 
        //Profile Update 
        Route::get('/edit-profile', 'Trainer\DashboardController@editProfile');
        Route::post('/update-profile', 'Trainer\DashboardController@updateProfile');
        Route::post('/update-password', 'Trainer\DashboardController@updatePassword');

        Route::post('/addClient', 'Trainer\DashboardController@addClient');
        Route::get('/allClients', 'Trainer\DashboardController@index');

        //Excersice
        Route::post('/storeExercise', 'Trainer\ExerciseController@store');
        Route::get('/allExercise', 'Trainer\ExerciseController@index');
        Route::get('/editExercise/{id}', 'Trainer\ExerciseController@edit');
        Route::post('/updatedExcercise', 'Trainer\ExerciseController@update');

        //WorkoutTemplate
        Route::post('/storeWorkoutTemplate', 'Trainer\WorkoutController@storeWorkoutTemplate');
        Route::get('/allWorkoutTemplate', 'Trainer\WorkoutController@allWorkoutTemplate');

       //Workout
        Route::get('/workout/{id}', 'Trainer\WorkoutController@allWorkout');
        Route::post('/add-exercise', 'Trainer\WorkoutController@addExcersice');
        Route::delete('/delete-exercise/{type_id}/{exercise_id}', 'Trainer\WorkoutController@deleteExercise');
        Route::get('/edit-exercise/{type_id}/{exercise_id}', 'Trainer\WorkoutController@editExercise');
        Route::post('/update-exercise', 'Trainer\WorkoutController@updateExercise');
        Route::post('/add-superset', 'Trainer\WorkoutController@addSuperset');
        Route::post('/add-circuit', 'Trainer\WorkoutController@addCircuit');
        Route::post('/add-exercise-superset', 'Trainer\WorkoutController@addExcersiceSuperset');
        Route::get('/edit-note-superset/{id}', 'Trainer\WorkoutController@editNotesSuperset');
        Route::post('/update-note-superset', 'Trainer\WorkoutController@updateNotesSuperset');
        Route::post('/add-note', 'Trainer\WorkoutController@addNote');
        Route::post('/update-note', 'Trainer\WorkoutController@updateNote');
        Route::get('/edit-note/{id}', 'Trainer\WorkoutController@editNote');
        Route::delete('/delete-note/{id}', 'Trainer\WorkoutController@deleteNote');
        //Meals
        Route::post('/storeMeal', 'Trainer\MealController@store');
        Route::get('/allMeal', 'Trainer\MealController@index');
        Route::get('/editMeal/{id}', 'Trainer\MealController@edit');
        Route::post('/updateMeal', 'Trainer\MealController@update');

        //Nutrition Plan
        Route::get('/nutrtion-plan', 'Trainer\NutritionPlanController@index');
        Route::post('/nutrtion-plan-store', 'Trainer\NutritionPlanController@storeNutrtionPlan');
        Route::get('/nutrtion-weekly-plan/{id}', 'Trainer\NutritionPlanController@nutritionPlanData');
        
        Route::get('/nutrtion-daily-plan/{id}', 'Trainer\NutritionPlanController@nutritionPlanDataDaily');
        Route::post('/nutrtion-add-meal', 'Trainer\NutritionPlanController@addMeal');
        
        Route::post('/nutrtion-add-food', 'Trainer\NutritionPlanController@addFood');
        Route::get('/nutrtion-create-food/{id}', 'Trainer\NutritionPlanController@createFood');
        Route::delete('/nutrtion-delete-food/{type_id}/{meal_id}', 'Trainer\NutritionPlanController@deleteFood');
        Route::delete('/nutrtion-delete-meal/{id}', 'Trainer\NutritionPlanController@deleteMeal');
        Route::post('/nutrtion-update-meal', 'Trainer\NutritionPlanController@updateMeal');

        //Workout plan 
        Route::get('/workout-plan', 'Trainer\WorkoutPlanController@index');
        Route::post('/workout-plan-add', 'Trainer\WorkoutPlanController@addWorkoutPlan');
        Route::get('/workout-weekly-plan/{id}', 'Trainer\WorkoutPlanController@workoutPlanData');
        Route::get('workout-week-add/{id}','Trainer\WorkoutPlanController@weekAdd');
        Route::get('/workout-daily-plan/{id}', 'Trainer\WorkoutPlanController@workoutPlanDataDaily');
        Route::post('/add-exercise-plan', 'Trainer\WorkoutPlanController@addExcersice');
        Route::get('/edit-exercise-plan/{type_id}/{exercise_id}', 'Trainer\WorkoutPlanController@editExercise');
        Route::post('/update-exercise-plan', 'Trainer\WorkoutPlanController@updateExercise');
        Route::post('/add-superset-plan', 'Trainer\WorkoutPlanControlle@addSuperset');
        Route::post('/add-circuit-plan', 'Trainer\WorkoutPlanControlle@addCircuit');
        Route::post('/add-exercise-superset-plan', 'Trainer\WorkoutPlanControlle@addExcersiceSuperset');
        Route::get('/edit-note-superset-plan/{id}', 'Trainer\WorkoutPlanControlle@editNotesSuperset');
        Route::post('/update-note-superset-plan', 'Trainer\WorkoutPlanControlle@updateNotesSuperset');
        Route::post('/add-note-plan', 'Trainer\WorkoutPlanControlle@addNote');
        Route::post('/update-note-plan', 'Trainer\WorkoutPlanControlle@updateNote');
        Route::get('/edit-note-plan/{id}', 'Trainer\WorkoutPlanControlle@editNote');
        Route::delete('/delete-note-plan/{id}', 'Trainer\WorkoutPlanControlle@deleteNote');


        //Groups
        Route::get('/group', 'Trainer\GroupController@index');
        Route::post('/add-group', 'Trainer\GroupController@addGroup');
        Route::get('/group-members/{id}', 'Trainer\GroupController@groupMembers');
        Route::post('/add-members', 'Trainer\GroupController@addMembers');
        Route::get('/workout-weeks/{id}', 'Trainer\WorkoutPlanController@allWorkoutTemplateWeeks');
        Route::post('/assign-workout', 'Trainer\WorkoutPlanController@assignWorkout');



        /**Client Apis  */
        Route::get('/due-workout', 'Client\AssignWorkoutController@dueWorkout');
    });
Route::group([
    'middleware' => ['auth:api' ]
],
    function () { 
        Route::get('/due-workout', 'Client\AssignWorkoutController@dueWorkoutDays');
        Route::get('/next-workout', 'Client\AssignWorkoutController@dueWorkout');

        /**Assessment */
        Route::get('/assessment', 'Client\AssessmentController@assessmentType');
        Route::get('/assessment/{id}', 'Client\AssessmentController@assessment');
        Route::post('/assessment-add', 'Client\AssessmentController@addAssessment');
        Route::post('/assessment-update', 'Client\AssessmentController@update');

        /**Free style Workout */
        Route::post('/free-style-workout', 'Client\FreeStyleWorkoutController@store');

        /** News  */
        Route::get('/news', 'NewsController@index');
        Route::get('/news-comment/{id}', 'NewsController@comments');
        Route::post('/news-comment-store', 'NewsController@storeComments');
        Route::post('/news-like-store', 'NewsController@storeLikes');

        /**Post */
        Route::post('/post-store', 'NewsController@storePost');
    });