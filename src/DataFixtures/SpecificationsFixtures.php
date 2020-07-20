<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Ads\Category;
use App\Entity\Ads\Specification;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;



class SpecificationsFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {


        $thisYear = date('Y');
        $specificationOffer =[
            //Vehicles--------------------------------------------------------------------------------------------------
            // car Engine Capacity
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Car'],
            ['name'=>'manufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Car','choice'=>['min'=>1940,'max'=>$thisYear]],
            ['name'=>'color', 'type'=>'ColorType', 'category'=>'Car'],
            ['name'=>'numberOfPassengers', 'type'=>'ChoiceType', 'category'=>'Car','typeOfChoice'=>'SequentialNumericOptions','choice'=>['min'=>1,'max'=>48]],
            ['name'=>'fuelType', 'type'=>'ChoiceType', 'category'=>'Car','typeOfChoice'=>'TextOptions', 'choice'=>['Gasoline','Diesel','LPG','Electric','Hybrid']],
            ['name'=>'numberOfDoors', 'type'=>'ChoiceType', 'category'=>'Car','typeOfChoice'=>'SequentialNumericOptions','choice'=>['min'=>1,'max'=>8]],
            ['name'=>'kilometer', 'type'=>'TextType', 'category'=>'Car'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Car'],
            ['name'=>'changeGear', 'type'=>'ChoiceType', 'category'=>'Car','typeOfChoice'=>'TextOptions', 'choice'=>['Automatic','Manual']],
            ['name'=>'ability','label'=>'Engine capacity (liter)', 'type'=>'TextType', 'category'=>'Car'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Car'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Car'],

            // Motor
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Motor'],
            ['name'=>'manufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Motor','choice'=>['min'=>1940,'max'=>$thisYear]],
            ['name'=>'color', 'type'=>'ColorType', 'category'=>'Motor'],
            ['name'=>'capacity','label'=>'Capacity (cm³)', 'type'=>'TextType', 'category'=>'Motor'],
            ['name'=>'kilometer', 'type'=>'TextType', 'category'=>'Motor'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Motor'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Motor'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Motor'],

            // Caravan
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Caravan'],
            ['name'=>'manufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Caravan','choice'=>['min'=>1940,'max'=>$thisYear]],
            ['name'=>'color', 'type'=>'ColorType', 'category'=>'Caravan'],
            ['name'=>'fuelType', 'type'=>'ChoiceType', 'category'=>'Caravan','typeOfChoice'=>'TextOptions', 'choice'=>['Gasoline','Diesel','LPG','Electric','Hybrid']],
            ['name'=>'kilometer', 'type'=>'TextType', 'category'=>'Caravan'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Caravan'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Caravan'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Caravan'],
            // Boat
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Boat'],
            ['name'=>'manufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Boat','choice'=>['min'=>1940,'max'=>$thisYear]],
            ['name'=>'color', 'type'=>'ColorType', 'category'=>'Boat'],
            ['name'=>'fuelType', 'type'=>'ChoiceType', 'category'=>'Boat','typeOfChoice'=>'TextOptions', 'choice'=>['Gasoline','Diesel','LPG','Electric','Hybrid']],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Boat'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Boat'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Boat'],
            // Agricultural machinery
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Agricultural machinery'],
            ['name'=>'manufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Agricultural machinery','choice'=>['min'=>1940,'max'=>$thisYear]],
            ['name'=>'color', 'type'=>'ColorType', 'category'=>'Agricultural machinery'],
            ['name'=>'fuelType', 'type'=>'ChoiceType', 'category'=>'Agricultural machinery','typeOfChoice'=>'TextOptions', 'choice'=>['Gasoline','Diesel','LPG','Electric','Hybrid']],
            ['name'=>'kilometer', 'type'=>'TextType', 'category'=>'Agricultural machinery'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Agricultural machinery'],
            ['name'=>'ability', 'type'=>'TextType', 'category'=>'Agricultural machinery'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Agricultural machinery'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Agricultural machinery'],
            // Car parts
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Car parts'],
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Car parts'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Car parts','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Car parts'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Car parts'],
            // Motor parts
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Motor parts'],
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Motor parts'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Motor parts','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Motor parts'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Motor parts'],
            // Vehicle accessories
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Vehicle accessories'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Vehicle accessories'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Vehicle accessories','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Vehicle accessories'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Vehicle accessories'],

            // vehicle_other
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'vehicle_other'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'vehicle_other'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'vehicle_other'],


            //Jobs and services-------------------------------------------------------------------------------------
            // Job opportunity
            ['name'=>'mission', 'type'=>'TextType', 'category'=>'Job opportunity'],
            ['name'=>'activityArea', 'type'=>'ChoiceType', 'category'=>'Job opportunity','typeOfChoice'=>'TextOptions', 'choice'=>['Agriculture','Mining and quarrying ','Manufacturing','Electricity/gas','Construction','Transporting','food service','Information','Financial and insurance','Real estate','scientific and technical','Administrative and support','Public administration','Education','Human health','Arts','General services','Rights and Law','Tourism and Hotels','Fashion']],
            ['name'=>'workHours', 'type'=>'ChoiceType', 'category'=>'Job opportunity','typeOfChoice'=>'TextOptions', 'choice'=>['Full','Partial']],
            ['name'=>'salary','label'=>'Salary (€)', 'type'=>'TextType', 'category'=>'Job opportunity'],
            ['name'=>'city', 'type'=>'EntityType', 'category'=>'Job opportunity'],
            ['name'=>'typeOfContract', 'type'=>'ChoiceType', 'category'=>'Job opportunity','typeOfChoice'=>'TextOptions', 'choice'=>['CDI','CDD','CTT','CUI','alternation','Independent']],
            ['name'=>'experience', 'type'=>'ChoiceType', 'category'=>'Job opportunity','typeOfChoice'=>'TextOptions', 'choice'=>['Not required' => 0,'1 YEAR'=> 1,'2 YEARS' => 2,'3 YEARS' => 3,'4 YEARS' => 4,'5 YEARS' => 5,'+ 5 YEARS' => 6]],
            ['name'=>'levelOfStudy', 'type'=>'ChoiceType', 'category'=>'Job opportunity','typeOfChoice'=>'TextOptions', 'choice'=>['Not required','High School','Diploma','University','Postgraduate']],

            // Translation
            ['name'=>'languages', 'type'=>'ChoiceType', 'category'=>'Translation','typeOfChoice'=>'TextOptions', 'choice'=>['English','German','Italian','Spanish','Ukrainian','Polish','Dutch','Turkish','Romanian','Arabic','Austro-Bavarian','Russian','Hungarian','Greek','Czech','Portuguese','Swedish','Bulgarian','Albanian','Slovak','Chinese','Japanese','Indian','Vietnamese','Persian','Indonesian']],
            ['name'=>'typeOfTranslation', 'type'=>'ChoiceType', 'category'=>'Translation','typeOfChoice'=>'TextOptions', 'choice'=>['Immediate translation','Translate documents','All']],
            ['name'=>'city', 'type'=>'EntityType', 'category'=>'Translation'],

            // Mathematics lessons
            ['name'=>'durationOfLesson','label'=>'Duration of lesson (minute)', 'type'=>'ChoiceType', 'category'=>'Mathematics lessons','typeOfChoice'=>'NumericOptions', 'choice'=>[45,60,75,90,105,120,180]],
            ['name'=>'placeOfLesson', 'type'=>'ChoiceType', 'category'=>'Mathematics lessons','typeOfChoice'=>'TextOptions', 'choice'=>['At the student','At the teacher','Not important','Other']],
            ['name'=>'city', 'type'=>'EntityType', 'category'=>'Mathematics lessons'],
            ['name'=>'levelOfStudent', 'type'=>'ChoiceType', 'category'=>'Mathematics lessons','typeOfChoice'=>'TextOptions', 'choice'=>['Maternal school'=>1,'Middle school'=>2,'High school'=>3,'Universities'=>4,'Professional'=>5]],
            ['name'=>'maxDistance','label'=>'Max distance (km)', 'type'=>'ChoiceType', 'category'=>'Mathematics lessons','typeOfChoice'=>'NumericOptions', 'choice'=>[5,10,15,20,30,40,50,60,70]],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Mathematics lessons'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Mathematics lessons'],
            // Music lessons
            ['name'=>'durationOfLesson','label'=>'Duration of lesson (minute)', 'type'=>'ChoiceType', 'category'=>'Music lessons','typeOfChoice'=>'NumericOptions', 'choice'=>[45,60,75,90,105,120,180]],
            ['name'=>'placeOfLesson', 'type'=>'ChoiceType', 'category'=>'Music lessons','typeOfChoice'=>'TextOptions', 'choice'=>['At the student','At the teacher','Not important','Other']],
            ['name'=>'city', 'type'=>'EntityType', 'category'=>'Music lessons'],
            ['name'=>'subjectName', 'type'=>'ChoiceType', 'category'=>'Music lessons','typeOfChoice'=>'TextOptions', 'choice'=>['piano','Violin','Trumpet','Flute','Clarinet','Cello','Contrabass','Guitar','digital keyboard','accordion','Rhythm','Solfege','Other']],
            ['name'=>'maxDistance','label'=>'Max distance (km)', 'type'=>'ChoiceType', 'category'=>'Music lessons','typeOfChoice'=>'NumericOptions', 'choice'=>[5,10,15,20,30,40,50,60,70]],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Music lessons'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Music lessons'],

            // Language lessons
            ['name'=>'subjectName', 'type'=>'ChoiceType', 'category'=>'Language lessons','typeOfChoice'=>'TextOptions', 'choice'=>['English','German','Italian','Spanish','Turkish','Arabic','Russian','Greek','Portuguese','Swedish','Chinese','Japanese','Other']],
            ['name'=>'durationOfLesson','label'=>'Duration of lesson (minute)', 'type'=>'ChoiceType', 'category'=>'Language lessons','typeOfChoice'=>'NumericOptions', 'choice'=>[45,60,75,90,105,120]],
            ['name'=>'placeOfLesson', 'type'=>'ChoiceType', 'category'=>'Language lessons','typeOfChoice'=>'TextOptions', 'choice'=>['At the student','At the teacher','Not important']],
            ['name'=>'city', 'type'=>'EntityType', 'category'=>'Language lessons'],
            ['name'=>'levelOfStudent', 'type'=>'ChoiceType', 'category'=>'Language lessons','typeOfChoice'=>'TextOptions', 'choice'=>['Maternal school'=>1,'Middle school'=>2,'High school'=>3,'Universities'=>4,'Professional'=>5]],
            ['name'=>'maxDistance','label'=>'Max distance (km)', 'type'=>'ChoiceType', 'category'=>'Language lessons','typeOfChoice'=>'NumericOptions', 'choice'=>[5,10,15,20,30,40,50,60,70]],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Language lessons'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Language lessons'],
            // Language exchange
            ['name'=>'language', 'type'=>'ChoiceType', 'category'=>'Language exchange','typeOfChoice'=>'TextOptions', 'choice'=>['French','English','German','Italian','Spanish','Ukrainian','Polish','Dutch','Turkish','Romanian','Arabic','Austro-Bavarian','Russian','Hungarian','Greek','Czech','Portuguese','Swedish','Bulgarian','Albanian','Slovak','Chinese','Japanese','Indian','Vietnamese','Persian','Indonesian','Other']],
            ['name'=>'secondLanguage', 'type'=>'ChoiceType', 'category'=>'Language exchange','typeOfChoice'=>'TextOptions', 'choice'=>['French','English','German','Italian','Spanish','Ukrainian','Polish','Dutch','Turkish','Romanian','Arabic','Austro-Bavarian','Russian','Hungarian','Greek','Czech','Portuguese','Swedish','Bulgarian','Albanian','Slovak','Chinese','Japanese','Indian','Vietnamese','Persian','Indonesian','Other']],
            ['name'=>'city', 'type'=>'EntityType', 'category'=>'Language exchange'],
            ['name'=>'maxDistance', 'type'=>'ChoiceType', 'category'=>'Language exchange','typeOfChoice'=>'NumericOptions', 'choice'=>[5,10,15,20,30,40,50,60,70]],

            // House work
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'House work'],
            ['name'=>'material', 'type'=>'TextType', 'category'=>'House work'],
            ['name'=>'city', 'type'=>'EntityType', 'category'=>'House work'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'House work'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'House work'],
            // Maintenance services
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Maintenance services'],
            ['name'=>'placeOfLesson', 'type'=>'ChoiceType','label'=>'Place Of Servic', 'category'=>'Maintenance services','typeOfChoice'=>'TextOptions', 'choice'=>['At your house','At us','Not important']],
            ['name'=>'city', 'type'=>'EntityType', 'category'=>'Maintenance services'],
            ['name'=>'maxDistance','label'=>'Max distance (km)', 'type'=>'ChoiceType', 'category'=>'Maintenance services','typeOfChoice'=>'NumericOptions', 'choice'=>[5,10,15,20,30,40,50,60,70]],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Maintenance services'],
            // jobs_other
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'jobs_other'],
            ['name'=>'city', 'type'=>'EntityType', 'category'=>'jobs_other'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'jobs_other'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'jobs_other'],




            //Media-------------------------------------------------------------------------------------------
            //TV
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'TV'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'TV','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'theType', 'type'=>'ChoiceType', 'category'=>'TV','typeOfChoice'=>'TextOptions', 'choice'=>['Normal','Smart']],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'TV'],
            ['name'=>'screenSizeCm', 'type'=>'TextType', 'category'=>'TV'],
            ['name'=>'screenSizeInch', 'type'=>'TextType', 'category'=>'TV'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'TV'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'TV'],
            //Wolkman
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Wolkman'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Wolkman','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Wolkman'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Wolkman'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Wolkman'],
            // Camera
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Camera'],
            ['name'=>'accuracy','label'=>'Accuracy (mp)', 'type'=>'TextType', 'category'=>'Camera'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Camera','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Camera'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Camera'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Camera'],
            //Audio accessories
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Audio accessories'],
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Audio accessories'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Audio accessories'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Audio accessories'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Audio accessories'],
            //Camera accessories
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Camera accessories'],
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Camera accessories'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Camera accessories'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Camera accessories'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Camera accessories'],
            //Headphones
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Headphones'],
            ['name'=>'capacity','label'=>'Power (watt)', 'type'=>'TextType', 'category'=>'Headphones'],
            ['name'=>'wifi', 'type'=>'CheckboxType', 'category'=>'Headphones'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Headphones','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Headphones'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Headphones'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Headphones'],
            //Telephone
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Telephone'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Telephone','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Telephone'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Telephone'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Telephone'],
            //Video games
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Video games'],
            ['name'=>'accessories', 'type'=>'CheckboxType', 'category'=>'Video games'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Video games'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Video games'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Video games'],
            //DVD Games
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'DVD Games'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'DVD Games'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'DVD Games'],
            //Games accessories
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Games accessories'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Games accessories','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Games accessories'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Games accessories'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Games accessories'],
            //Movies
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Movies'],
            ['name'=>'dvdCd', 'label'=>'DVD CD', 'type'=>'ChoiceType', 'category'=>'Movies','typeOfChoice'=>'TextOptions', 'choice'=>['DVD','CD']],
            ['name'=>'language', 'type'=>'ChoiceType', 'category'=>'Movies','typeOfChoice'=>'TextOptions', 'choice'=>['French','English','German','Italian','Spanish','Ukrainian','Polish','Dutch','Turkish','Romanian','Arabic','Austro-Bavarian','Russian','Hungarian','Greek','Czech','Portuguese','Swedish','Bulgarian','Albanian','Slovak','Chinese','Japanese','Indian','Vietnamese','Persian','Indonesian','Other']],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Movies'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Movies'],

            //Books
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Books'],
            ['name'=>'language', 'type'=>'ChoiceType', 'category'=>'Books','typeOfChoice'=>'TextOptions', 'choice'=>['French','English','German','Italian','Spanish','Ukrainian','Polish','Dutch','Turkish','Romanian','Arabic','Austro-Bavarian','Russian','Hungarian','Greek','Czech','Portuguese','Swedish','Bulgarian','Albanian','Slovak','Chinese','Japanese','Indian','Vietnamese','Persian','Indonesian','Other']],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Books'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Books'],
            //media_Other
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'media_Other'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'media_Other'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'media_Other'],



            //informations--------------------------------------------------------------------------
            // Computer
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Computer'],
            ['name'=>'processor', 'type'=>'TextType', 'category'=>'Computer'],
            ['name'=>'capacity', 'label'=>'HDD Capacity (gb)','type'=>'ChoiceType', 'category'=>'Computer','typeOfChoice'=>'NumericOptions', 'choice'=>[60,100,120,160,200,250,300,500,720,750,800,1000,2000,3000,4000,8000]],
            ['name'=>'ram', 'label'=>'RAM Capacity (gb)','type'=>'ChoiceType', 'category'=>'Computer','typeOfChoice'=>'NumericOptions', 'choice'=>[1,2,3,4,6,8,12,16,24,32,64]],
            ['name'=>'screenSizeCm', 'type'=>'TextType', 'category'=>'Computer'],
            ['name'=>'screenSizeInch', 'type'=>'TextType', 'category'=>'Computer'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Computer','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Computer'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Computer'],
            // laptop
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'laptop'],
            ['name'=>'processor', 'type'=>'TextType', 'category'=>'laptop'],
            ['name'=>'capacity', 'label'=>'HDD Capacity (gb)','type'=>'ChoiceType', 'category'=>'laptop','typeOfChoice'=>'NumericOptions', 'choice'=>[60,100,120,160,200,250,300,500,720,750,800,1000,2000,3000,4000,8000]],
            ['name'=>'ram', 'label'=>'RAM Capacity (gb)','type'=>'ChoiceType', 'category'=>'laptop','typeOfChoice'=>'NumericOptions', 'choice'=>[1,2,3,4,6,8,12,16,24,32,64]],
            ['name'=>'screenSizeCm', 'type'=>'TextType', 'category'=>'laptop'],
            ['name'=>'screenSizeInch', 'type'=>'TextType', 'category'=>'laptop'],
            ['name'=>'hdmi', 'type'=>'CheckboxType', 'category'=>'laptop'],
            ['name'=>'cdRoom', 'type'=>'CheckboxType', 'category'=>'laptop'],
            ['name'=>'accessories', 'type'=>'CheckboxType', 'category'=>'laptop'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'laptop'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'laptop','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'laptop'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'laptop'],
            // Tablet
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Tablet'],
            ['name'=>'capacity', 'label'=>'SSD Capacity (gb)','type'=>'ChoiceType', 'category'=>'Tablet','typeOfChoice'=>'NumericOptions', 'choice'=>[4,8,12,16,32,64,128,256,512,1024]],
            ['name'=>'ram', 'label'=>'RAM Capacity (gb)','type'=>'ChoiceType', 'category'=>'Tablet','typeOfChoice'=>'NumericOptions', 'choice'=>[0.5,1,2,3,4,6,8,16]],
            ['name'=>'screenSizeCm', 'type'=>'TextType', 'category'=>'Tablet'],
            ['name'=>'screenSizeInch', 'type'=>'TextType', 'category'=>'Tablet'],
            ['name'=>'accessories', 'type'=>'CheckboxType', 'category'=>'Tablet'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Tablet'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Tablet','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Tablet'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Tablet'],
            // Mobile
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Mobile'],
            ['name'=>'capacity', 'label'=>'SSD Capacity (gb)','type'=>'ChoiceType', 'category'=>'Mobile','typeOfChoice'=>'NumericOptions', 'choice'=>[4,8,12,16,32,64,128,256,512,1024]],
            ['name'=>'ram', 'label'=>'RAM Capacity (gb)','type'=>'ChoiceType', 'category'=>'Mobile','typeOfChoice'=>'NumericOptions', 'choice'=>[0.5,1,2,3,4,6,8,16]],
            ['name'=>'screenSizeCm', 'type'=>'TextType', 'category'=>'Mobile'],
            ['name'=>'screenSizeInch', 'type'=>'TextType', 'category'=>'Mobile'],
            ['name'=>'accessories', 'type'=>'CheckboxType', 'category'=>'Mobile'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Mobile'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Mobile','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Mobile'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Mobile'],
            // Scanner
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Scanner'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Scanner'],
            ['name'=>'wifi', 'type'=>'CheckboxType', 'category'=>'Scanner'],
            ['name'=>'usb', 'type'=>'CheckboxType', 'category'=>'Scanner'],
            ['name'=>'paperSize', 'type'=>'ChoiceType', 'category'=>'Scanner','typeOfChoice'=>'TextOptions', 'choice'=>['4A0' => 1,'2A0' => 2,'A0' => 3,'A1'=>4,'A2'=>5,'A3'=>6,'A4'=>7,'A5'=>8,'A6'=>9,'A7'=>10,'A8'=>11,'A9'=>12,'A10'=>13]],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Scanner','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Scanner'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Scanner'],
            // Printer
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Printer'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Printer'],
            ['name'=>'printingType', 'type'=>'ChoiceType', 'category'=>'Printer','typeOfChoice'=>'TextOptions', 'choice'=>['Inkjet','Laser','Other']],
            ['name'=>'printingColor', 'type'=>'ChoiceType', 'category'=>'Printer','typeOfChoice'=>'TextOptions', 'choice'=>['Black and white','Colored','Other']],
            ['name'=>'wifi', 'type'=>'CheckboxType', 'category'=>'Printer'],
            ['name'=>'usb', 'type'=>'CheckboxType', 'category'=>'Printer'],
            ['name'=>'threeInOne', 'type'=>'CheckboxType', 'category'=>'Printer'],
            ['name'=>'paperSize', 'type'=>'ChoiceType', 'category'=>'Printer','typeOfChoice'=>'TextOptions', 'choice'=>['4A0' => 1,'2A0' => 2,'A0' => 3,'A1'=>4,'A2'=>5,'A3'=>6,'A4'=>7,'A5'=>8,'A6'=>9,'A7'=>10,'A8'=>11,'A9'=>12,'A10'=>13]],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Printer','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Printer'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Printer'],
            // Monitor
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Monitor'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Monitor'],
            ['name'=>'hdmi', 'type'=>'CheckboxType', 'category'=>'Monitor'],
            ['name'=>'usb', 'type'=>'CheckboxType', 'category'=>'Monitor'],
            ['name'=>'screenSizeCm', 'type'=>'TextType', 'category'=>'Monitor'],
            ['name'=>'screenSizeInch', 'type'=>'TextType', 'category'=>'Monitor'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Monitor','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Monitor'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Monitor'],
            // information_mouse
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'information_mouse'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'information_mouse'],
            ['name'=>'wifi', 'type'=>'CheckboxType', 'category'=>'information_mouse'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'information_mouse','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'information_mouse'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'information_mouse'],
            // keyboard
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'keyboard'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'keyboard'],
            ['name'=>'languages', 'type'=>'ChoiceType', 'category'=>'keyboard','typeOfChoice'=>'TextOptions', 'choice'=>['English','German','Italian','Spanish','Ukrainian','Polish','Dutch','Turkish','Romanian','Arabic','Austro-Bavarian','Russian','Hungarian','Greek','Czech','Portuguese','Swedish','Bulgarian','Albanian','Slovak','Chinese','Japanese','Indian','Vietnamese','Persian','Indonesian']],
            ['name'=>'wifi', 'type'=>'CheckboxType', 'category'=>'keyboard'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'keyboard','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'keyboard'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'keyboard'],
            // Speaker
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Speaker'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Speaker'],
            ['name'=>'capacity','label'=>'Power (watt)', 'type'=>'TextType', 'category'=>'Speaker'],
            ['name'=>'wifi', 'type'=>'CheckboxType', 'category'=>'Speaker'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Speaker','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Speaker'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Speaker'],
            // Hard disk
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Hard disk'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Hard disk'],
            ['name'=>'capacity', 'label'=>'HDD Capacity (gb)','type'=>'ChoiceType', 'category'=>'Hard disk','typeOfChoice'=>'NumericOptions', 'choice'=>[60,100,120,160,200,250,300,500,720,750,800,1000,2000,3000,4000,8000]],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Hard disk','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Hard disk'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Hard disk'],

            // information_Other
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'information_Other'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'information_Other'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'information_Other'],



            //fashions-------------------------------------------------------------------------------------------------
            // T-shirt
            ['name'=>'sSize', 'label'=>'Size','type'=>'ChoiceType', 'category'=>'T-shirt','typeOfChoice'=>'TextOptions', 'choice'=>['XS','S','M','L','XL','XXL','XXXL']],
            ['name'=>'color', 'type'=>'ColorType', 'category'=>'T-shirt'],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'T-shirt','typeOfChoice'=>'TextOptions', 'choice'=>['Wool','Cotton','Linen','Leather','Polyster','Cloth','jeans','Other']],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'T-shirt'],
            ['name'=>'theType', 'type'=>'ChoiceType', 'category'=>'T-shirt','typeOfChoice'=>'TextOptions', 'choice'=>['Men','Women']],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'T-shirt'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'T-shirt'],
            // Shirt
            ['name'=>'sSize', 'label'=>'Size','type'=>'ChoiceType', 'category'=>'Shirt','typeOfChoice'=>'TextOptions', 'choice'=>['XS','S','M','L','XL','XXL','XXXL']],
            ['name'=>'color', 'type'=>'ColorType', 'category'=>'Shirt'],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Shirt','typeOfChoice'=>'TextOptions', 'choice'=>['Wool','Cotton','Linen','Leather','Polyster','Cloth','jeans','Other']],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Shirt'],
            ['name'=>'theType', 'type'=>'ChoiceType', 'category'=>'Shirt','typeOfChoice'=>'TextOptions', 'choice'=>['Men','Women']],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Shirt'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Shirt'],
            // Trouser
            ['name'=>'iSize', 'label'=>'Size','type'=>'ChoiceType', 'category'=>'Trouser','typeOfChoice'=>'NumericOptions', 'choice'=>[32,34,36,38,40,41,42,43,44,45,46,47,48,50,52,54,56,58,60,62]],
            ['name'=>'color', 'type'=>'ColorType', 'category'=>'Trouser'],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Trouser','typeOfChoice'=>'TextOptions', 'choice'=>['Wool','Cotton','Linen','Leather','Polyster','Cloth','Other']],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Trouser'],
            ['name'=>'theType', 'type'=>'ChoiceType', 'category'=>'Trouser','typeOfChoice'=>'TextOptions', 'choice'=>['Men','Women']],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Trouser'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Trouser'],
            // Short
            ['name'=>'iSize', 'label'=>'Size','type'=>'ChoiceType', 'category'=>'Short','typeOfChoice'=>'NumericOptions', 'choice'=>[32,34,36,38,40,41,42,43,44,45,46,47,48,50,52,54,56,58,60,62]],
            ['name'=>'color', 'type'=>'ColorType', 'category'=>'Short'],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Short','typeOfChoice'=>'TextOptions', 'choice'=>['Wool','Cotton','Linen','Leather','Polyster','Cloth','Other']],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Short'],
            ['name'=>'theType', 'type'=>'ChoiceType', 'category'=>'Short','typeOfChoice'=>'TextOptions', 'choice'=>['Men','Women']],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Short'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Short'],
            // Costume
            ['name'=>'sSize', 'label'=>'Size','type'=>'ChoiceType', 'category'=>'Costume','typeOfChoice'=>'TextOptions', 'choice'=>['XS','S','M','L','XL','XXL','XXXL']],
            ['name'=>'color', 'type'=>'ColorType', 'category'=>'Costume'],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Costume','typeOfChoice'=>'TextOptions', 'choice'=>['Wool','Cotton','Linen','Leather','Polyster','Cloth','Other']],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Costume'],
            ['name'=>'theType', 'type'=>'ChoiceType', 'category'=>'Costume','typeOfChoice'=>'TextOptions', 'choice'=>['Men','Women']],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Costume'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Costume'],
            // Dress
            ['name'=>'sSize', 'label'=>'Size','type'=>'ChoiceType', 'category'=>'Dress','typeOfChoice'=>'TextOptions', 'choice'=>['XS','S','M','L','XL','XXL','XXXL']],
            ['name'=>'color', 'type'=>'ColorType', 'category'=>'Dress'],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Dress','typeOfChoice'=>'TextOptions', 'choice'=>['Felt','Hessian','chiffon','Velours','Denim','Mousseline','Popeline','Charmeuse','Taffeta','Habutai','Other']],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Dress'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Dress'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Dress'],
            // Wedding dress
            ['name'=>'sSize', 'label'=>'Size','type'=>'ChoiceType', 'category'=>'Wedding dress','typeOfChoice'=>'TextOptions', 'choice'=>['XS','S','M','L','XL','XXL','XXXL']],
            ['name'=>'color', 'type'=>'ColorType', 'category'=>'Wedding dress'],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Wedding dress','typeOfChoice'=>'TextOptions', 'choice'=>['Satin','Charmeuse','Chiffon','Organza','Tulle','Lace','mikado','radzmir','gazar','Other']],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Wedding dress'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Wedding dress'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Wedding dress'],
            // Jacket
            ['name'=>'sSize', 'label'=>'Size','type'=>'ChoiceType', 'category'=>'Jacket','typeOfChoice'=>'TextOptions', 'choice'=>['XS','S','M','L','XL','XXL','XXXL']],
            ['name'=>'color', 'type'=>'ColorType', 'category'=>'Jacket'],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Jacket','typeOfChoice'=>'TextOptions', 'choice'=>['Wool','Cotton','Linen','Leather','Polyster','Polyurethane','Fleece','Nylon','Cashmere','Shearling','Other']],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Jacket'],
            ['name'=>'theType', 'type'=>'ChoiceType', 'category'=>'Jacket','typeOfChoice'=>'TextOptions', 'choice'=>['Men','Women']],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Jacket'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Jacket'],
            // Langerie
            ['name'=>'sSize', 'label'=>'Size','type'=>'ChoiceType', 'category'=>'Langerie','typeOfChoice'=>'TextOptions', 'choice'=>['XS','S','M','L','XL','XXL','XXXL']],
            ['name'=>'color', 'type'=>'ColorType', 'category'=>'Langerie'],
            ['name'=>'material', 'type'=>'TextType', 'category'=>'Langerie'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Langerie'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Langerie'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Langerie'],
            // Shoe
            ['name'=>'iSize', 'label'=>'Size','type'=>'ChoiceType', 'category'=>'Shoe','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>36,'max'=>48]],
            ['name'=>'color', 'type'=>'ColorType', 'category'=>'Shoe'],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Shoe','typeOfChoice'=>'TextOptions', 'choice'=>['Leather','Textiles','Synthetics','Rubber','Polyster','Foam','Other']],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Shoe'],
            ['name'=>'theType', 'type'=>'ChoiceType', 'category'=>'Shoe','typeOfChoice'=>'TextOptions', 'choice'=>['Men','Women']],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Shoe'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Shoe'],
            // Slide sandal
            ['name'=>'iSize', 'label'=>'Size','type'=>'ChoiceType', 'category'=>'Slide sandal','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>36,'max'=>48]],
            ['name'=>'color', 'type'=>'ColorType', 'category'=>'Slide sandal'],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Slide sandal','typeOfChoice'=>'TextOptions', 'choice'=>['Leather','Textiles','Synthetics','Rubber','Polyster','Foam','Other']],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Slide sandal'],
            ['name'=>'theType', 'type'=>'ChoiceType', 'category'=>'Slide sandal','typeOfChoice'=>'TextOptions', 'choice'=>['Men','Women']],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Slide sandal'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Slide sandal'],
            // Athletic shoe
            ['name'=>'iSize', 'label'=>'Size','type'=>'ChoiceType', 'category'=>'Athletic shoe','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>36,'max'=>48]],
            ['name'=>'color', 'type'=>'ColorType', 'category'=>'Athletic shoe'],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Athletic shoe','typeOfChoice'=>'TextOptions', 'choice'=>['Leather','Textiles','Synthetics','Rubber','Polyster','Foam','Other']],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Athletic shoe'],
            ['name'=>'theType', 'type'=>'ChoiceType', 'category'=>'Athletic shoe','typeOfChoice'=>'TextOptions', 'choice'=>['Men','Women']],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Athletic shoe'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Athletic shoe'],
            // fashion_Other
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'fashion_Other'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'fashion_Other'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'fashion_Other'],



            //homeAppliances-------------------------------------------------------------------------------------------
            //Refrigerator
            ['name'=>'color', 'type'=>'ColorType', 'category'=>'Refrigerator'],
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Refrigerator'],
            ['name'=>'capacity', 'label'=>'Capacity (liter)','type'=>'ChoiceType', 'category'=>'Refrigerator','typeOfChoice'=>'TextOptions', 'choice'=>['Less than 50 Liters'=> 1,'50-80 Liters'=> 2,'80-150 Liters'=> 3,'150-250 Liters'=> 4,'250-330 Liters'=>5,'330-490 Liters'=> 6,'More than 50 Liters'=>7]],
            ['name'=>'length', 'label'=>'Length (cm)', 'type'=>'TextType', 'category'=>'Refrigerator'],
            ['name'=>'width', 'label'=>'Width (cm)', 'type'=>'TextType', 'category'=>'Refrigerator'],
            ['name'=>'height', 'label'=>'Height (cm)', 'type'=>'TextType', 'category'=>'Refrigerator'],
            ['name'=>'withFreezer', 'type'=>'CheckboxType', 'category'=>'Refrigerator'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Refrigerator'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Refrigerator'],

            //Cookers gas
            ['name'=>'color', 'type'=>'ColorType', 'category'=>'Cookers gas'],
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Cookers gas'],
            ['name'=>'fuelType','type'=>'ChoiceType', 'category'=>'Cookers gas','typeOfChoice'=>'TextOptions', 'choice'=>['City gas','Bottle gas']],
            ['name'=>'numberOfHead','type'=>'ChoiceType', 'category'=>'Cookers gas','typeOfChoice'=>'NumericOptions', 'choice'=>[1,2,3,4,5,6,7,8]],
            ['name'=>'length', 'label'=>'Length (cm)', 'type'=>'TextType', 'category'=>'Cookers gas'],
            ['name'=>'width', 'label'=>'Width (cm)', 'type'=>'TextType', 'category'=>'Cookers gas'],
            ['name'=>'height', 'label'=>'Height (cm)', 'type'=>'TextType', 'category'=>'Cookers gas'],
            ['name'=>'withOven', 'type'=>'CheckboxType', 'category'=>'Cookers gas'],
            ['name'=>'electricHead', 'type'=>'CheckboxType', 'category'=>'Cookers gas'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Cookers gas'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Cookers gas'],
            //Cookers electric
            ['name'=>'color', 'type'=>'ColorType', 'category'=>'Cookers electric'],
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Cookers electric'],
            ['name'=>'numberOfHead','type'=>'ChoiceType', 'category'=>'Cookers electric','typeOfChoice'=>'NumericOptions', 'choice'=>[1,2,3,4,5,6,7,8]],
            ['name'=>'length', 'label'=>'Length (cm)', 'type'=>'TextType', 'category'=>'Cookers electric'],
            ['name'=>'width', 'label'=>'Width (cm)', 'type'=>'TextType', 'category'=>'Cookers electric'],
            ['name'=>'height', 'label'=>'Height (cm)', 'type'=>'TextType', 'category'=>'Cookers electric'],
            ['name'=>'withOven', 'type'=>'CheckboxType', 'category'=>'Cookers electric'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Cookers electric'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Cookers electric'],
            //Gas plate
            ['name'=>'color', 'type'=>'ColorType', 'category'=>'Gas plate'],
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Gas plate'],
            ['name'=>'numberOfHead','type'=>'ChoiceType', 'category'=>'Gas plate','typeOfChoice'=>'NumericOptions', 'choice'=>[1,2,3,4,5,6,7,8]],
            ['name'=>'length', 'label'=>'Length (cm)', 'type'=>'TextType', 'category'=>'Gas plate'],
            ['name'=>'width', 'label'=>'Width (cm)', 'type'=>'TextType', 'category'=>'Gas plate'],
            ['name'=>'height', 'label'=>'Height (cm)', 'type'=>'TextType', 'category'=>'Gas plate'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Gas plate'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Gas plate'],
            //Washing machine
            ['name'=>'color', 'type'=>'ColorType', 'category'=>'Washing machine'],
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Washing machine'],
            ['name'=>'capacity', 'label'=>'Capacity (kg)','type'=>'ChoiceType', 'category'=>'Washing machine','typeOfChoice'=>'NumericOptions', 'choice'=>[3,4,5,6,7,8,9,10,12]],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Washing machine'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Washing machine'],
            //Fan
            ['name'=>'color', 'type'=>'ColorType', 'category'=>'Fan'],
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Fan'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Fan'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Fan'],
            //Coffee machine
            ['name'=>'color', 'type'=>'ColorType', 'category'=>'Coffee machine'],
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Coffee machine'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Coffee machine'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Coffee machine'],
            //Electric kettle
            ['name'=>'color', 'type'=>'ColorType', 'category'=>'Electric kettle'],
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Electric kettle'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Electric kettle'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Electric kettle'],
            //Vaccuum cleaner
            ['name'=>'color', 'type'=>'ColorType', 'category'=>'Vaccuum cleaner'],
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Vaccuum cleaner'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Vaccuum cleaner'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Vaccuum cleaner'],
            //Oven
            ['name'=>'color', 'type'=>'ColorType', 'category'=>'Oven'],
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Oven'],
            ['name'=>'length', 'label'=>'Length (cm)', 'type'=>'TextType', 'category'=>'Oven'],
            ['name'=>'width', 'label'=>'Width (cm)', 'type'=>'TextType', 'category'=>'Oven'],
            ['name'=>'height', 'label'=>'Height (cm)', 'type'=>'TextType', 'category'=>'Oven'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Oven'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Oven'],
            //Blender
            ['name'=>'color', 'type'=>'ColorType', 'category'=>'Blender'],
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Blender'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Blender'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Blender'],
            //Stand Mixer
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Stand Mixer'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Stand Mixer'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Stand Mixer'],
            //Dishwashers
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Dishwashers'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Dishwashers'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Dishwashers'],
            //Electric fryer
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Electric fryer'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Electric fryer'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Electric fryer'],
            //Freezer
            ['name'=>'color', 'type'=>'ColorType', 'category'=>'Freezer'],
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Freezer'],
            ['name'=>'length', 'label'=>'Length (cm)', 'type'=>'TextType', 'category'=>'Freezer'],
            ['name'=>'width', 'label'=>'Width (cm)', 'type'=>'TextType', 'category'=>'Freezer'],
            ['name'=>'height', 'label'=>'Height (cm)', 'type'=>'TextType', 'category'=>'Freezer'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Freezer'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Freezer'],
            //Pressure cooker
            ['name'=>'color', 'type'=>'ColorType', 'category'=>'Pressure cooker'],
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Pressure cooker'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Pressure cooker'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Pressure cooker'],
            //Heater
            ['name'=>'color', 'type'=>'ColorType', 'category'=>'Heater'],
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Heater'],
            ['name'=>'fuelType', 'type'=>'ChoiceType', 'category'=>'Heater','typeOfChoice'=>'TextOptions', 'choice'=>['Gas','Diesel','fuelwood','Electric','Other']],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Heater'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Heater'],
            //Iron
            ['name'=>'color', 'type'=>'ColorType', 'category'=>'Iron'],
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Iron'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Iron'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Iron'],
            //Men's shaver
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Men\'s shaver'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Men\'s shaver'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Men\'s shaver'],
            //Lady shavers
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Lady shavers'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Lady shavers'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Lady shavers'],
            //Sandwich toaster
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Sandwich toaster'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Sandwich toaster'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Sandwich toaster'],
            //Meat grinder
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Meat grinder'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Meat grinder'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Meat grinder'],
            //Grilling charcoal
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Grilling charcoal'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Grilling charcoal'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Grilling charcoal'],
            //Hair dryer
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Hair dryer'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Hair dryer'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Hair dryer'],
            //Juicer machine
            ['name'=>'color', 'type'=>'ColorType', 'category'=>'Juicer machine'],
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Juicer machine'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Juicer machine'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Juicer machine'],
            //Electric vegetable
            ['name'=>'color', 'type'=>'ColorType', 'category'=>'Electric vegetable'],
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Electric vegetable'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Electric vegetable'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Electric vegetable'],
            //Kitchen accessories
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Kitchen accessories'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Kitchen accessories'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Kitchen accessories'],
            //home_Other
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'home_Other'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'home_Other'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'home_Other'],



            //gardens--------------------------------------------------------------------------------------------------
            // Garden table
            ['name'=>'color', 'type'=>'ColorType', 'category'=>'Garden table'],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Garden table','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Other']],
            ['name'=>'length', 'label'=>'Length (cm)', 'type'=>'TextType', 'category'=>'Garden table'],
            ['name'=>'width', 'label'=>'Width (cm)', 'type'=>'TextType', 'category'=>'Garden table'],
            ['name'=>'height', 'label'=>'Height (cm)', 'type'=>'TextType', 'category'=>'Garden table'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Garden table'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Garden table'],
            // Swing
            ['name'=>'color', 'type'=>'ColorType', 'category'=>'Swing'],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Swing','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Other']],
            ['name'=>'numberOfPersson','type'=>'ChoiceType', 'category'=>'Swing','typeOfChoice'=>'NumericOptions', 'choice'=>[1,2,3,4,5,6,7,8]],
            ['name'=>'length', 'label'=>'Length (cm)', 'type'=>'TextType', 'category'=>'Swing'],
            ['name'=>'width', 'label'=>'Width (cm)', 'type'=>'TextType', 'category'=>'Swing'],
            ['name'=>'height', 'label'=>'Height (cm)', 'type'=>'TextType', 'category'=>'Swing'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Swing'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Swing'],
            // Seedlings
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Seedlings'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Seedlings'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Seedlings'],
            // Garden chair
            ['name'=>'color', 'type'=>'ColorType', 'category'=>'Garden chair'],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Garden chair','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Other']],
            ['name'=>'number', 'label'=>'Number (unit)','type'=>'ChoiceType', 'category'=>'Garden chair','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>50]],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Garden chair'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Garden chair'],
            // Lawn mower
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Lawn mower'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Lawn mower'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Lawn mower'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Lawn mower'],
            // Chainsaw
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Chainsaw'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Chainsaw'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Chainsaw'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Chainsaw'],
            // Garden tools
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Garden tools'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Garden tools'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Garden tools'],
            // Fuelwood
            ['name'=>'material', 'type'=>'TextType', 'category'=>'Fuelwood'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Fuelwood'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Fuelwood'],
            // Electric generator
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Electric generator'],
            ['name'=>'capacity', 'label'=>'Power (watt)', 'type'=>'TextType', 'category'=>'Electric generator'],
            ['name'=>'fuelType', 'type'=>'ChoiceType', 'category'=>'Electric generator','typeOfChoice'=>'TextOptions', 'choice'=>['Diesel','Gasoline','Gas','Other']],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Electric generator'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Electric generator'],
            // garden_Other
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'garden_Other'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'garden_Other'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'garden_Other'],





            //residences------------------------------------------------------------------------------------------------
            // Sell house
            ['name'=>'withFurniture', 'type'=>'CheckboxType', 'category'=>'Sell house'],
            ['name'=>'withGarden', 'type'=>'CheckboxType', 'category'=>'Sell house'],
            ['name'=>'city', 'type'=>'EntityType', 'category'=>'Sell house'],
            ['name'=>'area','label'=>'Area (m²)', 'type'=>'TextType', 'category'=>'Sell house'],
            ['name'=>'numberOfRooms','type'=>'ChoiceType', 'category'=>'Sell house','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>12]],
            ['name'=>'heatingType', 'type'=>'ChoiceType', 'category'=>'Sell house','typeOfChoice'=>'TextOptions', 'choice'=>['Diesel','Electricity','Fuelwood','Gas','Other']],
            ['name'=>'classEnergie', 'type'=>'ChoiceType', 'category'=>'Sell house','typeOfChoice'=>'TextOptions', 'choice'=>['A'=> 1,'B'=> 2,'C' => 3,'D' => 4,'E'=>5,'F'=>6,'G'=>7]],
            ['name'=>'ges', 'type'=>'ChoiceType', 'category'=>'Sell house','typeOfChoice'=>'TextOptions', 'choice'=>['A'=> 1,'B'=> 2,'C' => 3,'D' => 4,'E'=>5,'F'=>6,'G'=>7]],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Sell house'],

            // Sell apartment
            ['name'=>'withFurniture', 'type'=>'CheckboxType', 'category'=>'Sell apartment'],
            ['name'=>'withVerandah', 'type'=>'CheckboxType', 'category'=>'Sell apartment'],
            ['name'=>'withElevator', 'type'=>'CheckboxType', 'category'=>'Sell apartment'],
            ['name'=>'city', 'type'=>'EntityType', 'category'=>'Sell apartment'],
            ['name'=>'area','label'=>'Area (m²)', 'type'=>'TextType', 'category'=>'Sell apartment'],
            ['name'=>'numberOfRooms','type'=>'ChoiceType', 'category'=>'Sell apartment','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>12]],
            ['name'=>'heatingType', 'type'=>'ChoiceType', 'category'=>'Sell apartment','typeOfChoice'=>'TextOptions', 'choice'=>['Diesel','Electricity','Fuelwood','Gas','Other']],
            ['name'=>'heating', 'type'=>'ChoiceType', 'category'=>'Sell apartment','typeOfChoice'=>'TextOptions', 'choice'=>['Individually','Collective','Other']],
            ['name'=>'floor','type'=>'ChoiceType', 'category'=>'Sell apartment','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>0,'max'=>50]],
            ['name'=>'numberOfFloors','label'=>'Floors in the building','type'=>'ChoiceType', 'category'=>'Sell apartment','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>0,'max'=>50]],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Sell apartment'],

            // Sell office
            ['name'=>'withFurniture', 'type'=>'CheckboxType', 'category'=>'Sell office'],
            ['name'=>'withElevator', 'type'=>'CheckboxType', 'category'=>'Sell office'],
            ['name'=>'city', 'type'=>'EntityType', 'category'=>'Sell office'],
            ['name'=>'area','label'=>'Area (m²)', 'type'=>'TextType', 'category'=>'Sell office'],
            ['name'=>'numberOfRooms','type'=>'ChoiceType', 'category'=>'Sell office','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>12]],
            ['name'=>'heatingType', 'type'=>'ChoiceType', 'category'=>'Sell office','typeOfChoice'=>'TextOptions', 'choice'=>['Diesel','Electricity','Fuelwood','Gas','Other']],
            ['name'=>'heating', 'type'=>'ChoiceType', 'category'=>'Sell office','typeOfChoice'=>'TextOptions', 'choice'=>['Individually','Collective','Other']],
            ['name'=>'floor','type'=>'ChoiceType', 'category'=>'Sell office','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>0,'max'=>50]],
            ['name'=>'numberOfFloors','label'=>'Floors in the building','type'=>'ChoiceType', 'category'=>'Sell office','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>0,'max'=>50]],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Sell office'],

            // Sell shop
            ['name'=>'city', 'type'=>'EntityType', 'category'=>'Sell shop'],
            ['name'=>'area','label'=>'Area (m²)', 'type'=>'TextType', 'category'=>'Sell shop'],
            ['name'=>'heatingType', 'type'=>'ChoiceType', 'category'=>'Sell shop','typeOfChoice'=>'TextOptions', 'choice'=>['Diesel','Electricity','Gas','Other']],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Sell shop'],

            // Sell car parking
            ['name'=>'city', 'type'=>'EntityType', 'category'=>'Sell car parking'],
            ['name'=>'covered', 'type'=>'CheckboxType', 'category'=>'Sell car parking'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Sell car parking'],

            // Sell farm
            ['name'=>'city', 'type'=>'EntityType', 'category'=>'Sell farm'],
            ['name'=>'area','label'=>'Area (m²)', 'type'=>'TextType', 'category'=>'Sell farm'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Sell farm'],

            // Rent house
            ['name'=>'withFurniture', 'type'=>'CheckboxType', 'category'=>'Rent house'],
            ['name'=>'withGarden', 'type'=>'CheckboxType', 'category'=>'Rent house'],
            ['name'=>'city', 'type'=>'EntityType', 'category'=>'Rent house'],
            ['name'=>'area','label'=>'Area (m²)', 'type'=>'TextType', 'category'=>'Rent house'],
            ['name'=>'numberOfRooms','type'=>'ChoiceType', 'category'=>'Rent house','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>12]],
            ['name'=>'heatingType', 'type'=>'ChoiceType', 'category'=>'Rent house','typeOfChoice'=>'TextOptions', 'choice'=>['Diesel','Electricity','Fuelwood','Gas','Other']],
            ['name'=>'classEnergie', 'type'=>'ChoiceType', 'category'=>'Rent house','typeOfChoice'=>'TextOptions', 'choice'=>['A'=> 1,'B'=> 2,'C' => 3,'D' => 4,'E'=>5,'F'=>6,'G'=>7]],
            ['name'=>'ges', 'type'=>'ChoiceType', 'category'=>'Rent house','typeOfChoice'=>'TextOptions', 'choice'=>['A'=> 1,'B'=> 2,'C' => 3,'D' => 4,'E'=>5,'F'=>6,'G'=>7]],
            ['name'=>'price','label'=>'Rent', 'type'=>'TextType', 'category'=>'Rent house'],
            // Rent apartment
            ['name'=>'withFurniture', 'type'=>'CheckboxType', 'category'=>'Rent apartment'],
            ['name'=>'withVerandah', 'type'=>'CheckboxType', 'category'=>'Rent apartment'],
            ['name'=>'withElevator', 'type'=>'CheckboxType', 'category'=>'Rent apartment'],
            ['name'=>'city', 'type'=>'EntityType', 'category'=>'Rent apartment'],
            ['name'=>'area','label'=>'Area (m²)', 'type'=>'TextType', 'category'=>'Rent apartment'],
            ['name'=>'numberOfRooms','type'=>'ChoiceType', 'category'=>'Rent apartment','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>12]],
            ['name'=>'heatingType', 'type'=>'ChoiceType', 'category'=>'Rent apartment','typeOfChoice'=>'TextOptions', 'choice'=>['Diesel','Electricity','Fuelwood','Gas','Other']],
            ['name'=>'heating', 'type'=>'ChoiceType', 'category'=>'Rent apartment','typeOfChoice'=>'TextOptions', 'choice'=>['Individually','Collective','Other']],
            ['name'=>'floor','type'=>'ChoiceType', 'category'=>'Rent apartment','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>0,'max'=>50]],
            ['name'=>'numberOfFloors','label'=>'Floors in the building','type'=>'ChoiceType', 'category'=>'Rent apartment','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>0,'max'=>50]],
            ['name'=>'price','label'=>'Rent', 'type'=>'TextType', 'category'=>'Rent apartment'],

            // Office rental
            ['name'=>'withElevator', 'type'=>'CheckboxType', 'category'=>'Office rental'],
            ['name'=>'city', 'type'=>'EntityType', 'category'=>'Office rental'],
            ['name'=>'area','label'=>'Area (m²)', 'type'=>'TextType', 'category'=>'Office rental'],
            ['name'=>'numberOfRooms','type'=>'ChoiceType', 'category'=>'Office rental','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>12]],
            ['name'=>'heatingType', 'type'=>'ChoiceType', 'category'=>'Office rental','typeOfChoice'=>'TextOptions', 'choice'=>['Diesel','Electricity','Fuelwood','Gas','Other']],
            ['name'=>'heating', 'type'=>'ChoiceType', 'category'=>'Office rental','typeOfChoice'=>'TextOptions', 'choice'=>['Individually','Collective','Other']],
            ['name'=>'floor','type'=>'ChoiceType', 'category'=>'Office rental','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>0,'max'=>50]],
            ['name'=>'numberOfFloors','label'=>'Floors in the building','type'=>'ChoiceType', 'category'=>'Office rental','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>0,'max'=>50]],
            ['name'=>'price','label'=>'Rent', 'type'=>'TextType', 'category'=>'Office rental'],

            // Rent shop
            ['name'=>'city', 'type'=>'EntityType', 'category'=>'Rent shop'],
            ['name'=>'area','label'=>'Area (m²)', 'type'=>'TextType', 'category'=>'Rent shop'],
            ['name'=>'heatingType', 'type'=>'ChoiceType', 'category'=>'Rent shop','typeOfChoice'=>'TextOptions', 'choice'=>['Diesel','Electricity','Gas','Other']],
            ['name'=>'price','label'=>'Rent', 'type'=>'TextType', 'category'=>'Rent shop'],

            // Rent car parking
            ['name'=>'city', 'type'=>'EntityType', 'category'=>'Rent car parking'],
            ['name'=>'covered', 'type'=>'CheckboxType', 'category'=>'Rent car parking'],
            ['name'=>'price','label'=>'Rent', 'type'=>'TextType', 'category'=>'Rent car parking'],

            // Rent farm
            ['name'=>'city', 'type'=>'EntityType', 'category'=>'Rent farm'],
            ['name'=>'area','label'=>'Area (m²)', 'type'=>'TextType', 'category'=>'Rent farm'],
            ['name'=>'price','label'=>'Rent', 'type'=>'TextType', 'category'=>'Rent farm'],

            // Collective housing
            ['name'=>'theType', 'type'=>'ChoiceType', 'category'=>'Collective housing','typeOfChoice'=>'TextOptions', 'choice'=>['House','Apartment','Residential center','Other']],
            ['name'=>'withFurniture', 'type'=>'CheckboxType', 'category'=>'Collective housing'],
            ['name'=>'withElevator', 'type'=>'CheckboxType', 'category'=>'Collective housing'],
            ['name'=>'city', 'type'=>'EntityType', 'category'=>'Collective housing'],
            ['name'=>'numberOfRooms','type'=>'ChoiceType', 'category'=>'Collective housing','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>12]],
            ['name'=>'heatingType', 'type'=>'ChoiceType', 'category'=>'Collective housing','typeOfChoice'=>'TextOptions', 'choice'=>['Diesel','Electricity','Fuelwood','Gas','Other']],
            ['name'=>'floor','type'=>'ChoiceType', 'category'=>'Collective housing','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>0,'max'=>50]],
            ['name'=>'numberOfFloors','label'=>'Floors in the building','type'=>'ChoiceType', 'category'=>'Collective housing','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>0,'max'=>50]],
            ['name'=>'price','label'=>'Rent', 'type'=>'TextType', 'category'=>'Collective housing'],

            // residence_Other
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'residence_Other'],
            ['name'=>'city', 'type'=>'EntityType', 'category'=>'residence_Other'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'residence_Other'],





            //jewelrys---------------------------------------------------------------------------------------------------
            // Necklaces
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Necklaces','typeOfChoice'=>'TextOptions', 'choice'=>['Silver','Silver filled','Yellow gold','White gold','Rose gold','Green gold','Base Metal','Platinum','Titanium','gemstone','mixed','Other']],
            ['name'=>'weight', 'label'=>'Weight (g)', 'type'=>'TextType', 'category'=>'Necklaces'],
            ['name'=>'caliber', 'type'=>'TextType', 'category'=>'Necklaces'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Necklaces'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Necklaces'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Necklaces'],
            // Collier
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Collier','typeOfChoice'=>'TextOptions', 'choice'=>['Silver','Silver filled','Yellow gold','White gold','Rose gold','Green gold','Base Metal','Platinum','Titanium','gemstone','mixed','Other']],
            ['name'=>'weight', 'label'=>'Weight (g)', 'type'=>'TextType', 'category'=>'Collier'],
            ['name'=>'caliber', 'type'=>'TextType', 'category'=>'Collier'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Collier'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Collier'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Collier'],
            // Bracelet
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Bracelet','typeOfChoice'=>'TextOptions', 'choice'=>['Silver','Silver filled','Yellow gold','White gold','Rose gold','Green gold','Base Metal','Platinum','Titanium','gemstone','mixed','Other']],
            ['name'=>'weight', 'label'=>'Weight (g)', 'type'=>'TextType', 'category'=>'Bracelet'],
            ['name'=>'caliber', 'type'=>'TextType', 'category'=>'Bracelet'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Bracelet'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Bracelet'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Bracelet'],
            // Ring
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Ring','typeOfChoice'=>'TextOptions', 'choice'=>['Silver','Silver filled','Yellow gold','White gold','Rose gold','Green gold','Base Metal','Platinum','Titanium','gemstone','mixed','Other']],
            ['name'=>'weight', 'label'=>'Weight (g)', 'type'=>'TextType', 'category'=>'Ring'],
            ['name'=>'caliber', 'type'=>'TextType', 'category'=>'Ring'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Ring'],
            ['name'=>'iSize', 'label'=>'Siz Of Ring','type'=>'ChoiceType', 'category'=>'Ring','typeOfChoice'=>'NumericOptions', 'choice'=>[45,47,50,53,57,60,63,66,69]],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Ring'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Ring'],
            // Watch
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Watch'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Watch'],
            ['name'=>'analogDigital', 'type'=>'ChoiceType', 'category'=>'Watch','typeOfChoice'=>'TextOptions', 'choice'=>['Analogue','Digital','Other']],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Watch'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Watch'],
            // Earrings
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Earrings','typeOfChoice'=>'TextOptions', 'choice'=>['Silver','Silver filled','Yellow gold','White gold','Rose gold','Green gold','Base Metal','Platinum','Titanium','gemstone','mixed','Other']],
            ['name'=>'weight', 'label'=>'Weight (g)', 'type'=>'TextType', 'category'=>'Earrings'],
            ['name'=>'caliber', 'type'=>'TextType', 'category'=>'Earrings'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Earrings'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Earrings'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Earrings'],
            // Perfumes
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Perfumes'],
            ['name'=>'capacity', 'label'=>'Capacity (ml)', 'type'=>'TextType', 'category'=>'Perfumes'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Perfumes'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Perfumes'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Perfumes'],
            // Wine
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Wine'],
            ['name'=>'capacity', 'label'=>'Capacity (ml)', 'type'=>'ChoiceType', 'category'=>'Wine','typeOfChoice'=>'NumericOptions', 'choice'=>[100,187,375,750,1000,1500,3000]],
            ['name'=>'manufacturingYear', 'type'=>'ChoiceType', 'category'=>'Wine','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1890,'max'=>$thisYear]],
            ['name'=>'originCountry', 'type'=>'ChoiceType', 'category'=>'Wine','typeOfChoice'=>'TextOptions', 'choice'=>['France','Italy','Spain','Chile','Australia','United States','Germany','New zealand','Portugal','Argentina','Croatia','Switzerland','Other']],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Wine'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Wine'],
            // jewelry_Other
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'jewelry_Other'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'jewelry_Other'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'jewelry_Other'],





            //musics---------------------------------------------------------------------------------------------------
            // Piano
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Piano'],
            ['name'=>'manufacturingYear', 'type'=>'ChoiceType', 'category'=>'Piano','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1920,'max'=>$thisYear]],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Piano'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Piano'],
            // Violin
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Violin'],
            ['name'=>'manufacturingYear', 'type'=>'ChoiceType', 'category'=>'Violin','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1920,'max'=>$thisYear]],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Violin'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Violin'],
            // Trumpet
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Trumpet'],
            ['name'=>'manufacturingYear', 'type'=>'ChoiceType', 'category'=>'Trumpet','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1920,'max'=>$thisYear]],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Trumpet'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Trumpet'],
            // Flute
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Flute'],
            ['name'=>'manufacturingYear', 'type'=>'ChoiceType', 'category'=>'Flute','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1920,'max'=>$thisYear]],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Flute'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Flute'],
            // Clarinet
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Clarinet'],
            ['name'=>'manufacturingYear', 'type'=>'ChoiceType', 'category'=>'Clarinet','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1920,'max'=>$thisYear]],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Clarinet'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Clarinet'],
            // Drums
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Drums'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Drums'],
            ['name'=>'manufacturingYear', 'type'=>'ChoiceType', 'category'=>'Drums','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1920,'max'=>$thisYear]],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Drums'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Drums'],
            // Cello
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Cello'],
            ['name'=>'manufacturingYear', 'type'=>'ChoiceType', 'category'=>'Cello','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1920,'max'=>$thisYear]],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Cello'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Cello'],
            // Contrabass
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Contrabass'],
            ['name'=>'manufacturingYear', 'type'=>'ChoiceType', 'category'=>'Contrabass','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1920,'max'=>$thisYear]],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Contrabass'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Contrabass'],
            // Electric guitar
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Electric guitar'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Electric guitar'],
            ['name'=>'manufacturingYear', 'type'=>'ChoiceType', 'category'=>'Electric guitar','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1940,'max'=>$thisYear]],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Electric guitar'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Electric guitar'],
            // Classic guitar
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Classic guitar'],
            ['name'=>'manufacturingYear', 'type'=>'ChoiceType', 'category'=>'Classic guitar','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1920,'max'=>$thisYear]],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Classic guitar'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Classic guitar'],
            // Digital keyboard
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Digital keyboard'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Digital keyboard'],
            ['name'=>'manufacturingYear', 'type'=>'ChoiceType', 'category'=>'Digital keyboard','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1920,'max'=>$thisYear]],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Digital keyboard'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Digital keyboard'],
            // Accordion
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Accordion'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Accordion'],
            ['name'=>'manufacturingYear', 'type'=>'ChoiceType', 'category'=>'Accordion','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1920,'max'=>$thisYear]],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Accordion'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Accordion'],
            // Music accessories
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Music accessories'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Music accessories'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Music accessories'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Music accessories'],
            // music_Other
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'music_Other'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'music_Other'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'music_Other'],



            //sports--------------------------------------------------------------------------------------------------
            // Ski boots
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Ski boots'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Ski boots'],
            ['name'=>'iSize', 'label'=>'Size', 'type'=>'ChoiceType', 'category'=>'Ski boots','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>32,'max'=>48]],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Ski boots','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'color', 'type'=>'ColorType', 'category'=>'Ski boots'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Ski boots'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Ski boots'],
            // Roller skating
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Roller skating'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Roller skating'],
            ['name'=>'iSize', 'label'=>'Size', 'type'=>'ChoiceType', 'category'=>'Roller skating','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>32,'max'=>48]],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Roller skating','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'color', 'type'=>'ColorType', 'category'=>'Roller skating'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Roller skating'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Roller skating'],
            // Parachute
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Parachute'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Parachute'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Parachute'],
            // Swimming glasses
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Swimming glasses'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Swimming glasses'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Swimming glasses'],
            // Football
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Football'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Football'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Football'],
            // Basketball
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Basketball'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Basketball'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Basketball'],
            // Iron balls
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Iron balls'],
            ['name'=>'number', 'label'=>'Number (unit)','type'=>'ChoiceType', 'category'=>'Iron balls','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>30]],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Iron balls'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Iron balls'],
            // Volley ball
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Volley ball'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Volley ball'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Volley ball'],
            // American football
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'American football'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'American football'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'American football'],
            // Sports tool
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Sports tool'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Sports tool','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Sports tool'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Sports tool'],
            // Bicycle
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Bicycle'],
            ['name'=>'color', 'type'=>'ColorType', 'category'=>'Bicycle'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Bicycle'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Bicycle','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Bicycle'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Bicycle'],
            // Bicycle accessories
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Bicycle accessories'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Bicycle accessories','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Bicycle accessories'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Bicycle accessories'],
            // sport_Other
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'sport_Other'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'sport_Other'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'sport_Other'],



            //Pets-----------------------------------------------------------------------------------------------------
            //  Cat
            ['name'=>'color', 'type'=>'ColorType', 'category'=>'Cat'],
            ['name'=>'age', 'label'=>'Age (year)', 'type'=>'TextType', 'category'=>'Cat'],
            ['name'=>'animalSpecies', 'type'=>'TextType', 'category'=>'Cat'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Cat'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Cat'],
            // Dog
            ['name'=>'color', 'type'=>'ColorType', 'category'=>'Dog'],
            ['name'=>'age', 'label'=>'Age (year)', 'type'=>'TextType', 'category'=>'Dog'],
            ['name'=>'animalSpecies', 'type'=>'TextType', 'category'=>'Dog'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Dog'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Dog'],
            // Hamster
            ['name'=>'color', 'type'=>'ColorType', 'category'=>'Hamster'],
            ['name'=>'age', 'label'=>'Age (year)', 'type'=>'TextType', 'category'=>'Hamster'],
            ['name'=>'animalSpecies', 'type'=>'TextType', 'category'=>'Hamster'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Hamster'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Hamster'],
            // Mouse
            ['name'=>'color', 'type'=>'ColorType', 'category'=>'Mouse'],
            ['name'=>'age', 'label'=>'Age (year)', 'type'=>'TextType', 'category'=>'Mouse'],
            ['name'=>'animalSpecies', 'type'=>'TextType', 'category'=>'Mouse'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Mouse'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Mouse'],
            // pet_Other
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'pet_Other'],
            ['name'=>'color', 'type'=>'ColorType', 'category'=>'pet_Other'],
            ['name'=>'age', 'label'=>'Age (year)', 'type'=>'TextType', 'category'=>'pet_Other'],
            ['name'=>'animalSpecies', 'type'=>'TextType', 'category'=>'pet_Other'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'pet_Other'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'pet_Other'],



            //kids------------------------------------------------------------------------------------------------------
            //  Crib
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Crib'],
            ['name'=>'length', 'label'=>'Length (cm)', 'type'=>'TextType', 'category'=>'Crib'],
            ['name'=>'width', 'label'=>'Width (cm)', 'type'=>'TextType', 'category'=>'Crib'],
            ['name'=>'height', 'label'=>'Height (cm)', 'type'=>'TextType', 'category'=>'Crib'],
            ['name'=>'color', 'type'=>'ColorType', 'category'=>'Crib'],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Crib','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Other']],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Crib'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Crib'],
            // kids_Chest of drawers
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'kids_Chest of drawers'],
            ['name'=>'length', 'label'=>'Length (cm)', 'type'=>'TextType', 'category'=>'kids_Chest of drawers'],
            ['name'=>'width', 'label'=>'Width (cm)', 'type'=>'TextType', 'category'=>'kids_Chest of drawers'],
            ['name'=>'height', 'label'=>'Height (cm)', 'type'=>'TextType', 'category'=>'kids_Chest of drawers'],
            ['name'=>'color', 'type'=>'ColorType', 'category'=>'kids_Chest of drawers'],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'kids_Chest of drawers','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Other']],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'kids_Chest of drawers'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'kids_Chest of drawers'],
            // Stroller
            ['name'=>'color', 'type'=>'ColorType', 'category'=>'Stroller'],
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Stroller'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Stroller'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Stroller'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Stroller'],
            // Diapers
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Diapers'],
            ['name'=>'iSize', 'label'=>'Size', 'type'=>'ChoiceType', 'category'=>'Diapers','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>0,'max'=>8]],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Diapers'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Diapers'],
            // kids_Mattress
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'kids_Mattress'],
            ['name'=>'length', 'label'=>'Length (cm)', 'type'=>'TextType', 'category'=>'kids_Mattress'],
            ['name'=>'width', 'label'=>'Width (cm)', 'type'=>'TextType', 'category'=>'kids_Mattress'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'kids_Mattress'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'kids_Mattress'],
            // Baby clothes
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Baby clothes'],
            ['name'=>'iSize', 'label'=>'Size', 'type'=>'ChoiceType', 'category'=>'Baby clothes','typeOfChoice'=>'NumericOptions', 'choice'=>[40,44,50,54,60,67,71,74,81,86,94,102,108,116,122,128,134,140,146,152,158,164,170,174,180]],
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Baby clothes'],
            ['name'=>'color', 'type'=>'ColorType', 'category'=>'Baby clothes'],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Baby clothes','typeOfChoice'=>'TextOptions', 'choice'=>['Cotton','Cloth','Polyester','Linen','Jeans','Wool','Silk','Other']],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Baby clothes'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Baby clothes'],
            // Baby tools
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Baby tools'],
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Baby tools'],
            ['name'=>'age', 'type'=>'ChoiceType', 'category'=>'Baby tools','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>15]],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Baby tools'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Baby tools'],
            // Baby toys
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Baby toys'],
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Baby toys'],
            ['name'=>'age', 'type'=>'ChoiceType', 'category'=>'Baby toys','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>15]],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Baby toys'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Baby toys'],
            // kid_Other
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'kid_Other'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'kid_Other'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'kid_Other'],



            // furnitures-----------------------------------------------------------------------------------------------
            //  Couch
            ['name'=>'numberOfPersson', 'type'=>'ChoiceType', 'category'=>'Couch','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>5]],
            ['name'=>'color', 'type'=>'ColorType', 'category'=>'Couch'],
            ['name'=>'coverMaterial', 'type'=>'ChoiceType', 'category'=>'Couch','typeOfChoice'=>'TextOptions', 'choice'=>['Cotton','Cloth','Leather','Linen','Velvet','Chamois','Other']],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Couch'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Couch'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Couch'],
            // Dining table
            ['name'=>'numberOfPersson', 'type'=>'ChoiceType', 'category'=>'Dining table','typeOfChoice'=>'NumericOptions', 'choice'=>[2,4,6,8,10,12,14]],
            ['name'=>'color', 'type'=>'ColorType', 'category'=>'Dining table'],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Dining table','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Other']],
            ['name'=>'shape', 'type'=>'ChoiceType', 'category'=>'Dining table','typeOfChoice'=>'TextOptions', 'choice'=>['Oval','Circular','Square','Rectangle','Complex','Other']],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Dining table'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Dining table'],
            // Chest of drawers
            ['name'=>'length', 'label'=>'Length (cm)', 'type'=>'TextType', 'category'=>'Chest of drawers'],
            ['name'=>'width', 'label'=>'Width (cm)', 'type'=>'TextType', 'category'=>'Chest of drawers'],
            ['name'=>'height', 'label'=>'Height (cm)', 'type'=>'TextType', 'category'=>'Chest of drawers'],
            ['name'=>'numberOfDrawer', 'type'=>'ChoiceType', 'category'=>'Chest of drawers','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>12]],
            ['name'=>'numberOfStaging', 'type'=>'ChoiceType', 'category'=>'Chest of drawers','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>12]],
            ['name'=>'numberOfDoors', 'type'=>'ChoiceType', 'category'=>'Chest of drawers','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>12]],
            ['name'=>'color', 'type'=>'ColorType', 'category'=>'Chest of drawers'],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Chest of drawers','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Other']],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Chest of drawers'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Chest of drawers'],
            // Closet
            ['name'=>'length', 'label'=>'Length (cm)', 'type'=>'TextType', 'category'=>'Closet'],
            ['name'=>'width', 'label'=>'Width (cm)', 'type'=>'TextType', 'category'=>'Closet'],
            ['name'=>'height', 'label'=>'Height (cm)', 'type'=>'TextType', 'category'=>'Closet'],
            ['name'=>'numberOfDrawer', 'type'=>'ChoiceType', 'category'=>'Closet','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>12]],
            ['name'=>'numberOfStaging', 'type'=>'ChoiceType', 'category'=>'Closet','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>12]],
            ['name'=>'numberOfDoors', 'type'=>'ChoiceType', 'category'=>'Closet','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>12]],
            ['name'=>'color', 'type'=>'ColorType', 'category'=>'Closet'],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Closet','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Other']],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Closet'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Closet'],
            // Central table
            ['name'=>'length', 'label'=>'Length (cm)', 'type'=>'TextType', 'category'=>'Central table'],
            ['name'=>'width', 'label'=>'Width (cm)', 'type'=>'TextType', 'category'=>'Central table'],
            ['name'=>'height', 'label'=>'Height (cm)', 'type'=>'TextType', 'category'=>'Central table'],
            ['name'=>'color', 'type'=>'ColorType', 'category'=>'Central table'],
            ['name'=>'shape', 'type'=>'ChoiceType', 'category'=>'Central table','typeOfChoice'=>'TextOptions', 'choice'=>['Oval','Circular','Square','Rectangle','Complex','Other']],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Central table','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Other']],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Central table'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Central table'],
            // Bed
            ['name'=>'length', 'label'=>'Length (cm)', 'type'=>'TextType', 'category'=>'Bed'],
            ['name'=>'width', 'label'=>'Width (cm)', 'type'=>'TextType', 'category'=>'Bed'],
            ['name'=>'height', 'label'=>'Height (cm)', 'type'=>'TextType', 'category'=>'Bed'],
            ['name'=>'numberOfPersson', 'type'=>'ChoiceType', 'category'=>'Bed','typeOfChoice'=>'TextOptions', 'choice'=>['1'=>1,'1.5'=>1.5,'2'=>2]],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Bed','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Mixed','Other']],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Bed'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Bed'],
            // Mattress'
            ['name'=>'color', 'type'=>'ColorType', 'category'=>'Mattress'],
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Mattress'],
            ['name'=>'length', 'label'=>'Length (cm)', 'type'=>'TextType', 'category'=>'Mattress'],
            ['name'=>'width', 'label'=>'Width (cm)', 'type'=>'TextType', 'category'=>'Mattress'],
            ['name'=>'height', 'label'=>'Height (cm)', 'type'=>'TextType', 'category'=>'Mattress'],
            ['name'=>'numberOfPersson', 'type'=>'ChoiceType', 'category'=>'Mattress','typeOfChoice'=>'TextOptions', 'choice'=>['1'=>1,'1.5'=>1.5,'2'=>2]],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Mattress'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Mattress'],
            //Quilt
            ['name'=>'color', 'type'=>'ColorType', 'category'=>'Quilt'],
            ['name'=>'length', 'label'=>'Length (cm)', 'type'=>'TextType', 'category'=>'Quilt'],
            ['name'=>'width', 'label'=>'Width (cm)', 'type'=>'TextType', 'category'=>'Quilt'],
            ['name'=>'height', 'label'=>'Height (cm)', 'type'=>'TextType', 'category'=>'Quilt'],
            ['name'=>'numberOfPersson', 'type'=>'ChoiceType', 'category'=>'Quilt','typeOfChoice'=>'TextOptions', 'choice'=>['1'=>1,'1.5'=>1.5,'2'=>2]],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Quilt'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Quilt'],
            //Carpet
            ['name'=>'length', 'label'=>'Length (cm)', 'type'=>'TextType', 'category'=>'Carpet'],
            ['name'=>'width', 'label'=>'Width (cm)', 'type'=>'TextType', 'category'=>'Carpet'],
            ['name'=>'color', 'type'=>'ColorType', 'category'=>'Carpet'],
            ['name'=>'shape', 'type'=>'ChoiceType', 'category'=>'Carpet','typeOfChoice'=>'TextOptions', 'choice'=>['Oval','Circular','Square','Rectangle','Complex','Other']],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Carpet'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Carpet'],
            //Chair
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Chair','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Mixed','Other']],
            ['name'=>'color', 'type'=>'ColorType', 'category'=>'Chair'],
            ['name'=>'number', 'label'=>'Number (unit)', 'type'=>'ChoiceType', 'category'=>'Chair','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>12]],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Chair'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Chair'],
            //Office chair
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Office chair','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Mixed','Other']],
            ['name'=>'color', 'type'=>'ColorType', 'category'=>'Office chair'],
            ['name'=>'number', 'label'=>'Number (unit)', 'type'=>'ChoiceType', 'category'=>'Office chair','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>12]],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Office chair'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Office chair'],
            //Sofa
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Sofa','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Mixed','Other']],
            ['name'=>'color', 'type'=>'ColorType', 'category'=>'Sofa'],
            ['name'=>'number', 'label'=>'Number (unit)', 'type'=>'ChoiceType', 'category'=>'Sofa','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>12]],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Sofa'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Sofa'],
            //Racks
            ['name'=>'color', 'type'=>'ColorType', 'category'=>'Racks'],
            ['name'=>'length', 'label'=>'Length (cm)', 'type'=>'TextType', 'category'=>'Racks'],
            ['name'=>'width', 'label'=>'Width (cm)', 'type'=>'TextType', 'category'=>'Racks'],
            ['name'=>'height', 'label'=>'Height (cm)', 'type'=>'TextType', 'category'=>'Racks'],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Racks','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Mixed','Other']],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Racks'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Racks'],
            //Study table
            ['name'=>'color', 'type'=>'ColorType', 'category'=>'Study table'],
            ['name'=>'length', 'label'=>'Length (cm)', 'type'=>'TextType', 'category'=>'Study table'],
            ['name'=>'width', 'label'=>'Width (cm)', 'type'=>'TextType', 'category'=>'Study table'],
            ['name'=>'height', 'label'=>'Height (cm)', 'type'=>'TextType', 'category'=>'Study table'],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Study table','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Mixed','Other']],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Study table'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Study table'],
            //Click clack
            ['name'=>'color', 'type'=>'ColorType', 'category'=>'Click clack'],
            ['name'=>'length', 'label'=>'Length (cm)', 'type'=>'TextType', 'category'=>'Click clack'],
            ['name'=>'width', 'label'=>'Width (cm)', 'type'=>'TextType', 'category'=>'Click clack'],
            ['name'=>'height', 'label'=>'Height (cm)', 'type'=>'TextType', 'category'=>'Click clack'],
            ['name'=>'numberOfPersson', 'type'=>'ChoiceType', 'category'=>'Click clack','typeOfChoice'=>'NumericOptions', 'choice'=>[1,2,3,4]],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Click clack'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Click clack'],
            //Nightstand
            ['name'=>'color', 'type'=>'ColorType', 'category'=>'Nightstand'],
            ['name'=>'length', 'label'=>'Length (cm)', 'type'=>'TextType', 'category'=>'Nightstand'],
            ['name'=>'width', 'label'=>'Width (cm)', 'type'=>'TextType', 'category'=>'Nightstand'],
            ['name'=>'height', 'label'=>'Height (cm)', 'type'=>'TextType', 'category'=>'Nightstand'],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Nightstand','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Mixed','Other']],
            ['name'=>'numberOfDrawer', 'type'=>'ChoiceType', 'category'=>'Nightstand','typeOfChoice'=>'NumericOptions', 'choice'=>[1,2,3,4]],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Nightstand'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Nightstand'],
            //Shoe cabinet
            ['name'=>'color', 'type'=>'ColorType', 'category'=>'Shoe cabinet'],
            ['name'=>'length', 'label'=>'Length (cm)', 'type'=>'TextType', 'category'=>'Shoe cabinet'],
            ['name'=>'width', 'label'=>'Width (cm)', 'type'=>'TextType', 'category'=>'Shoe cabinet'],
            ['name'=>'height', 'label'=>'Height (cm)', 'type'=>'TextType', 'category'=>'Shoe cabinet'],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Shoe cabinet','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Mixed','Other']],
            ['name'=>'numberOfDrawer', 'type'=>'ChoiceType', 'category'=>'Shoe cabinet','typeOfChoice'=>'NumericOptions', 'choice'=>[1,2,3,4,5,6,7,8]],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Shoe cabinet'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Shoe cabinet'],
            //Chandelier
            ['name'=>'color', 'type'=>'ColorType', 'category'=>'Chandelier'],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Chandelier','typeOfChoice'=>'TextOptions', 'choice'=>['Glass','Crystal','Carton','Funt','Metal','Wood','Plastic','Mixed','Other']],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Chandelier'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Chandelier'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Chandelier'],
            //Antic
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Antic'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Antic'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Antic'],
            //Painting
            ['name'=>'length', 'label'=>'Length (cm)', 'type'=>'TextType', 'category'=>'Painting'],
            ['name'=>'width', 'label'=>'Width (cm)', 'type'=>'TextType', 'category'=>'Painting'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Painting'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Painting'],
            //Roses
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Roses'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Roses'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Roses'],
            //Curtain
            ['name'=>'color', 'type'=>'ColorType', 'category'=>'Curtain'],
            ['name'=>'length', 'label'=>'Length (cm)', 'type'=>'TextType', 'category'=>'Curtain'],
            ['name'=>'width', 'label'=>'Width (cm)', 'type'=>'TextType', 'category'=>'Curtain'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Curtain'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Curtain'],
            //Floor lamp
            ['name'=>'length', 'label'=>'Length (cm)', 'type'=>'TextType', 'category'=>'Floor lamp'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Floor lamp'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Floor lamp'],
            //Mirror
            ['name'=>'length', 'label'=>'Length (cm)', 'type'=>'TextType', 'category'=>'Mirror'],
            ['name'=>'width', 'label'=>'Width (cm)', 'type'=>'TextType', 'category'=>'Mirror'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Mirror'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Mirror'],
            //furniture_Other
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'furniture_Other'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'furniture_Other'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'furniture_Other'],

            //holidays--------------------------------------------------------------------------------------------------
            //  Camp
            ['name'=>'city', 'type'=>'EntityType', 'category'=>'Camp'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Camp'],

            // Hotel
            ['name'=>'city', 'type'=>'EntityType', 'category'=>'Hotel'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Hotel'],

            // Cottage
            ['name'=>'city', 'type'=>'EntityType', 'category'=>'Cottage'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Cottage'],

            // Chalet
            ['name'=>'city', 'type'=>'EntityType', 'category'=>'Chalet'],
            ['name'=>'numberOfRooms','type'=>'ChoiceType', 'category'=>'Chalet','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>12]],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Chalet'],

            // Cards and reservations

            ['name'=>'eventType', 'label' => 'Type of events', 'type'=>'ChoiceType', 'category'=>'Cards and reservations','typeOfChoice'=>'TextOptions', 'choice'=>['Music','Cinema','Sport','Theater','Party','Resturant','Tourist','Travel','Other']],
            ['name'=>'city', 'type'=>'EntityType', 'category'=>'Cards and reservations'],
            ['name'=>'numberOfPersson', 'type'=>'ChoiceType', 'category'=>'Cards and reservations','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>8]],
            ['name'=>'number', 'label'=>'Number (unit)', 'type'=>'ChoiceType', 'category'=>'Cards and reservations','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>10]],
            ['name'=>'dateOfEvent', 'type'=>'DateType', 'category'=>'Cards and reservations'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'Cards and reservations'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Cards and reservations'],

            // holiday_Other
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'holiday_Other'],
            ['name'=>'city', 'type'=>'EntityType', 'category'=>'holiday_Other'],
            ['name'=>'price', 'type'=>'TextType', 'category'=>'holiday_Other'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'holiday_Other'],
        ];
//----------------------------------------------------------------------------------------------------------------------
        //------------------------------------------------------------------------------------------------
        //------------------------------------------------------------------------------------------------
        //------------------------------------------------------------------------------------------------
        $specificationDemand =[
            //Vehicles--------------------------------------------------------------------------------------------------
            // car
            ['name'=>'brand', 'type'=>'ChoiceType', 'category'=>'Car','typeOfChoice'=>'TextOptions', 'choice'=>['Peugeot','Renault','Citroen','DS','BMW','Mercedes-Benz','Opel','Volkswagen','Seat','Ford','Fiat','Alfa romeo','Dacia','Jaguar','Lotus','Lexus','Mini','Porsche','Volvo','Scoda','Tesla','Jeep','Land rover','Bentley','Infiniti','Toyota','Suzuki','Subaru','Nissan','Mitsubishi','Honda','Kia','Hyundai','Other']],
            ['name'=>'minManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Car','choice'=>['min'=>1945,'max'=>$thisYear]],
            ['name'=>'maxManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Car','choice'=>['min'=>1946,'max'=>$thisYear]],
            ['name'=>'numberOfPassengers','label'=>'MAX Number of passengers', 'type'=>'ChoiceType', 'category'=>'Car','typeOfChoice'=>'SequentialNumericOptions','choice'=>['min'=>1,'max'=>48]],
            ['name'=>'fuelType', 'type'=>'ChoiceType', 'category'=>'Car','typeOfChoice'=>'TextOptions', 'choice'=>['Gasoline','Diesel','LPG','Electric','Hybrid']],
            ['name'=>'numberOfDoors','label'=>'MAX Number of doors', 'type'=>'ChoiceType', 'category'=>'Car','typeOfChoice'=>'SequentialNumericOptions','choice'=>['min'=>1,'max'=>8]],
            ['name'=>'minKilometer', 'type'=>'ChoiceType', 'category'=>'Car','typeOfChoice'=>'NumericOptions', 'choice'=>[0,15000,30000,45000,60000,75000,90000,105000,120000,150000,180000,200000,225000,250000,275000,300000]],
            ['name'=>'maxKilometer', 'type'=>'ChoiceType', 'category'=>'Car','typeOfChoice'=>'NumericOptions', 'choice'=>[15000,30000,45000,60000,75000,90000,105000,120000,150000,180000,200000,225000,250000,275000,300000]],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Car'],
            ['name'=>'changeGear', 'type'=>'ChoiceType', 'category'=>'Car','typeOfChoice'=>'TextOptions', 'choice'=>['Automatic','Manual']],
            ['name'=>'price','label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Car'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Car'],

            // Motor   cm² cm³
            ['name'=>'brand', 'type'=>'ChoiceType', 'category'=>'Motor','typeOfChoice'=>'TextOptions', 'choice'=>['Midual','Peugeot','Vespa','Rds Side Cars','Scorpa','Gas Gas','Clipic Motor','Hyosung','Rieju','Derbi','Bmw','Muz','Harley - Davidson','Buell','Indian Motorcycle','Sherco','Atk','Royal Enfield','Triumph','Ccm Motorcycle','Aprilia','Borile','Benelli','Honda','Yamaha','Suzuki','Kawasaki','Toyota','Suzuki','Cagiva','Vertemati','Laverda','Ktm','Husqvarna','Ural Russian Motorcycle','Jawa','Boxer Design','BMS','Other']],
            ['name'=>'minManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Motor','choice'=>['min'=>1945,'max'=>$thisYear]],
            ['name'=>'maxManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Motor','choice'=>['min'=>1946,'max'=>$thisYear]],
            ['name'=>'minKilometer', 'type'=>'ChoiceType', 'category'=>'Motor','typeOfChoice'=>'NumericOptions', 'choice'=>[0,5000,10000,15000,30000,45000,60000,75000,90000,105000,120000,150000,180000,200000,225000,250000,275000,300000]],
            ['name'=>'maxKilometer', 'type'=>'ChoiceType', 'category'=>'Motor','typeOfChoice'=>'NumericOptions', 'choice'=>[5000,10000,15000,30000,45000,60000,75000,90000,105000,120000,150000,180000,200000,225000,250000,275000,300000]],
            ['name'=>'minCapacity','label'=>'MIN capacity (cm³)', 'type'=>'ChoiceType', 'category'=>'Motor','typeOfChoice'=>'NumericOptions', 'choice'=>[0,50,80,110,140,170,200,230,450,650,800,1000]],
            ['name'=>'maxCapacity','label'=>'MAX capacity (cm³)', 'type'=>'ChoiceType', 'category'=>'Motor','typeOfChoice'=>'NumericOptions', 'choice'=>[50,80,110,140,170,200,230,450,650,800,1000]],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Motor'],
            ['name'=>'price','label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Motor'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Motor'],

            // Caravan
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Caravan'],
            ['name'=>'minManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Caravan','choice'=>['min'=>1945,'max'=>$thisYear]],
            ['name'=>'maxManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Caravan','choice'=>['min'=>1946,'max'=>$thisYear]],
            ['name'=>'fuelType', 'type'=>'ChoiceType', 'category'=>'Caravan','typeOfChoice'=>'TextOptions', 'choice'=>['Gasoline','Diesel','LPG','Electric','Hybrid']],
            ['name'=>'minKilometer', 'type'=>'ChoiceType', 'category'=>'Caravan','typeOfChoice'=>'NumericOptions', 'choice'=>[0,15000,30000,45000,60000,75000,90000,105000,120000,150000,180000,200000,225000,250000,275000,300000]],
            ['name'=>'maxKilometer', 'type'=>'ChoiceType', 'category'=>'Caravan','typeOfChoice'=>'NumericOptions', 'choice'=>[15000,30000,45000,60000,75000,90000,105000,120000,150000,180000,200000,225000,250000,275000,300000]],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Caravan'],
            ['name'=>'price','label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Caravan'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Caravan'],
            // Boat
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Boat'],
            ['name'=>'minManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Boat','choice'=>['min'=>1945,'max'=>$thisYear]],
            ['name'=>'maxManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Boat','choice'=>['min'=>1946,'max'=>$thisYear]],
            ['name'=>'fuelType', 'type'=>'ChoiceType', 'category'=>'Boat','typeOfChoice'=>'TextOptions', 'choice'=>['Gasoline','Diesel','LPG','Electric','Hybrid']],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Boat'],
            ['name'=>'price','label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Boat'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Boat'],
            // Agricultural machinery
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Agricultural machinery'],
            ['name'=>'minManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Agricultural machinery','choice'=>['min'=>1945,'max'=>$thisYear]],
            ['name'=>'maxManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Agricultural machinery','choice'=>['min'=>1946,'max'=>$thisYear]],
            ['name'=>'fuelType', 'type'=>'ChoiceType', 'category'=>'Agricultural machinery','typeOfChoice'=>'TextOptions', 'choice'=>['Gasoline','Diesel','LPG','Electric','Hybrid']],
            ['name'=>'minKilometer', 'type'=>'ChoiceType', 'category'=>'Agricultural machinery','typeOfChoice'=>'NumericOptions', 'choice'=>[0,15000,30000,45000,60000,75000,90000,105000,120000,150000,180000,200000,225000,250000,275000,300000]],
            ['name'=>'maxKilometer', 'type'=>'ChoiceType', 'category'=>'Agricultural machinery','typeOfChoice'=>'NumericOptions', 'choice'=>[15000,30000,45000,60000,75000,90000,105000,120000,150000,180000,200000,225000,250000,275000,300000]],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Agricultural machinery'],
            ['name'=>'price','label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Agricultural machinery'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Agricultural machinery'],
            // Car parts
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Car parts'],
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Car parts'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Car parts','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'price','label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Car parts'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Car parts'],
            // Motor parts
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Motor parts'],
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Motor parts'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Motor parts','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'price','label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Motor parts'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Motor parts'],
            // Vehicle accessories
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Vehicle accessories'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Vehicle accessories'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Vehicle accessories','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'price','label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Vehicle accessories'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Vehicle accessories'],

            // vehicle_other
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'vehicle_other'],
            ['name'=>'price','label'=>'Price MAX', 'type'=>'TextType', 'category'=>'vehicle_other'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'vehicle_other'],


            //Jobs and services-------------------------------------------------------------------------------------
            // Job opportunity
            ['name'=>'activityArea', 'type'=>'ChoiceType', 'category'=>'Job opportunity','typeOfChoice'=>'TextOptions', 'choice'=>['Agriculture','Mining and quarrying ','Manufacturing','Electricity/gas','Construction','Transporting','food service','Information','Financial and insurance','Real estate','scientific and technical','Administrative and support','Public administration','Education','Human health','Arts','General services','Rights and Law','Tourism and Hotels','Fashion']],
            ['name'=>'workHours', 'type'=>'ChoiceType', 'category'=>'Job opportunity','typeOfChoice'=>'TextOptions', 'choice'=>['Full','Partial']],
            ['name'=>'salary','label'=>'Salary MIN (€)', 'type'=>'TextType', 'category'=>'Job opportunity'],
            ['name'=>'city', 'type'=>'EntityType', 'category'=>'Job opportunity'],
            ['name'=>'typeOfContract', 'type'=>'ChoiceType', 'category'=>'Job opportunity','typeOfChoice'=>'TextOptions', 'choice'=>['CDI','CDD','CTT','CUI','alternation','Independent']],
            ['name'=>'experience', 'type'=>'ChoiceType', 'category'=>'Job opportunity','typeOfChoice'=>'TextOptions', 'choice'=>['Not required' => 0,'1 YEAR'=> 1,'2 YEARS' => 2,'3 YEARS' => 3,'4 YEARS' => 4,'5 YEARS' => 5,'+ 5 YEARS' => 6]],
            ['name'=>'levelOfStudy', 'type'=>'ChoiceType', 'category'=>'Job opportunity','typeOfChoice'=>'TextOptions', 'choice'=>['Not required','High School','Diploma','University','Postgraduate']],

            // Translation
            ['name'=>'languages', 'type'=>'ChoiceType', 'category'=>'Translation','typeOfChoice'=>'TextOptions', 'choice'=>['English','German','Italian','Spanish','Ukrainian','Polish','Dutch','Turkish','Romanian','Arabic','Austro-Bavarian','Russian','Hungarian','Greek','Czech','Portuguese','Swedish','Bulgarian','Albanian','Slovak','Chinese','Japanese','Indian','Vietnamese','Persian','Indonesian']],
            ['name'=>'typeOfTranslation', 'type'=>'ChoiceType', 'category'=>'Translation','typeOfChoice'=>'TextOptions', 'choice'=>['Immediate translation','Translate documents','All']],
            ['name'=>'city', 'type'=>'EntityType', 'category'=>'Translation'],

            // Mathematics lessons
            ['name'=>'durationOfLesson','label'=>'Duration of lesson (minute)', 'type'=>'ChoiceType', 'category'=>'Mathematics lessons','typeOfChoice'=>'NumericOptions', 'choice'=>[45,60,75,90,105,120,180]],
            ['name'=>'placeOfLesson', 'type'=>'ChoiceType', 'category'=>'Mathematics lessons','typeOfChoice'=>'TextOptions', 'choice'=>['At the student','At the teacher','Not important','Other']],
            ['name'=>'city', 'type'=>'EntityType', 'category'=>'Mathematics lessons'],
            ['name'=>'levelOfStudent', 'type'=>'ChoiceType', 'category'=>'Mathematics lessons','typeOfChoice'=>'TextOptions', 'choice'=>['Maternal school'=>1,'Middle school'=>2,'High school'=>3,'Universities'=>4,'Professional'=>5]],
            ['name'=>'maxDistance','label'=>'Max distance (km)', 'type'=>'ChoiceType', 'category'=>'Mathematics lessons','typeOfChoice'=>'NumericOptions', 'choice'=>[5,10,15,20,30,40,50,60,70]],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Mathematics lessons'],
            // Music lessons
            ['name'=>'durationOfLesson','label'=>'Duration of lesson (minute)', 'type'=>'ChoiceType', 'category'=>'Music lessons','typeOfChoice'=>'NumericOptions', 'choice'=>[45,60,75,90,105,120,180]],
            ['name'=>'placeOfLesson', 'type'=>'ChoiceType', 'category'=>'Music lessons','typeOfChoice'=>'TextOptions', 'choice'=>['At the student','At the teacher','Not important','Other']],
            ['name'=>'city', 'type'=>'EntityType', 'category'=>'Music lessons'],
            ['name'=>'subjectName', 'type'=>'ChoiceType', 'category'=>'Music lessons','typeOfChoice'=>'TextOptions', 'choice'=>['piano','Violin','Trumpet','Flute','Clarinet','Cello','Contrabass','Guitar','digital keyboard','accordion','Rhythm','Solfege','Other']],
            ['name'=>'maxDistance','label'=>'Max distance (km)', 'type'=>'ChoiceType', 'category'=>'Music lessons','typeOfChoice'=>'NumericOptions', 'choice'=>[5,10,15,20,30,40,50,60,70]],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Music lessons'],

            // Language lessons
            ['name'=>'subjectName', 'type'=>'ChoiceType', 'category'=>'Language lessons','typeOfChoice'=>'TextOptions', 'choice'=>['English','German','Italian','Spanish','Turkish','Arabic','Russian','Greek','Portuguese','Swedish','Chinese','Japanese','Other']],
            ['name'=>'durationOfLesson','label'=>'Duration of lesson (minute)', 'type'=>'ChoiceType', 'category'=>'Language lessons','typeOfChoice'=>'NumericOptions', 'choice'=>[45,60,75,90,105,120]],
            ['name'=>'placeOfLesson', 'type'=>'ChoiceType', 'category'=>'Language lessons','typeOfChoice'=>'TextOptions', 'choice'=>['At the student','At the teacher','Not important']],
            ['name'=>'city', 'type'=>'EntityType', 'category'=>'Language lessons'],
            ['name'=>'levelOfStudent', 'type'=>'ChoiceType', 'category'=>'Language lessons','typeOfChoice'=>'TextOptions', 'choice'=>['Maternal school'=>1,'Middle school'=>2,'High school'=>3,'Universities'=>4,'Professional'=>5]],
            ['name'=>'maxDistance','label'=>'Max distance (km)', 'type'=>'ChoiceType', 'category'=>'Language lessons','typeOfChoice'=>'NumericOptions', 'choice'=>[5,10,15,20,30,40,50,60,70]],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Language lessons'],
            // Language exchange
            ['name'=>'language', 'type'=>'ChoiceType', 'category'=>'Language exchange','typeOfChoice'=>'TextOptions', 'choice'=>['French','English','German','Italian','Spanish','Ukrainian','Polish','Dutch','Turkish','Romanian','Arabic','Austro-Bavarian','Russian','Hungarian','Greek','Czech','Portuguese','Swedish','Bulgarian','Albanian','Slovak','Chinese','Japanese','Indian','Vietnamese','Persian','Indonesian','Other']],
            ['name'=>'secondLanguage', 'type'=>'ChoiceType', 'category'=>'Language exchange','typeOfChoice'=>'TextOptions', 'choice'=>['French','English','German','Italian','Spanish','Ukrainian','Polish','Dutch','Turkish','Romanian','Arabic','Austro-Bavarian','Russian','Hungarian','Greek','Czech','Portuguese','Swedish','Bulgarian','Albanian','Slovak','Chinese','Japanese','Indian','Vietnamese','Persian','Indonesian','Other']],
            ['name'=>'city', 'type'=>'EntityType', 'category'=>'Language exchange'],
            ['name'=>'maxDistance','label'=>'Max distance KM', 'type'=>'ChoiceType', 'category'=>'Language exchange','typeOfChoice'=>'NumericOptions', 'choice'=>[5,10,15,20,30,40,50,60,70]],

            // House work
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'House work'],
            ['name'=>'city', 'type'=>'EntityType', 'category'=>'House work'],
            ['name'=>'material', 'type'=>'TextType', 'category'=>'House work'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'House work'],
            // Maintenance services
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Maintenance services'],
            ['name'=>'placeOfLesson', 'type'=>'ChoiceType','label'=>'Place Of Servic', 'category'=>'Maintenance services','typeOfChoice'=>'TextOptions', 'choice'=>['At your house','At us','Not important']],
            ['name'=>'city', 'type'=>'EntityType', 'category'=>'Maintenance services'],
            ['name'=>'maxDistance','label'=>'Max distance (km)', 'type'=>'ChoiceType', 'category'=>'Maintenance services','typeOfChoice'=>'NumericOptions', 'choice'=>[5,10,15,20,30,40,50,60,70]],
            // jobs_other
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'jobs_other'],
            ['name'=>'city', 'type'=>'EntityType', 'category'=>'jobs_other'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'jobs_other'],




            //Media-------------------------------------------------------------------------------------------
            //TV
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'TV'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'TV','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'theType', 'type'=>'ChoiceType', 'category'=>'TV','typeOfChoice'=>'TextOptions', 'choice'=>['Normal','Smart']],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'TV'],
            ['name'=>'screenSizeCm', 'type'=>'TextType', 'category'=>'TV'],
            ['name'=>'screenSizeInch', 'type'=>'TextType', 'category'=>'TV'],
            ['name'=>'price','label'=>'Price MAX', 'type'=>'TextType', 'category'=>'TV'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'TV'],
            //Wolkman
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Wolkman'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Wolkman','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Wolkman'],
            ['name'=>'price','label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Wolkman'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Wolkman'],
            // Camera
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Camera'],
            ['name'=>'accuracy','label'=>'Accuracy (mp)', 'type'=>'TextType', 'category'=>'Camera'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Camera','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Camera'],
            ['name'=>'price','label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Camera'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Camera'],
            //Audio accessories
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Audio accessories'],
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Audio accessories'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Audio accessories'],
            ['name'=>'price','label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Audio accessories'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Audio accessories'],
            //Camera accessories
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Camera accessories'],
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Camera accessories'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Camera accessories'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Camera accessories'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Camera accessories'],
            //Headphones
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Headphones'],
            ['name'=>'capacity', 'label'=>'MIN power (watt)', 'type'=>'TextType', 'category'=>'Headphones'],
            ['name'=>'wifi', 'type'=>'CheckboxType', 'category'=>'Headphones'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Headphones','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Headphones'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Headphones'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Headphones'],
            //Telephone
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Telephone'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Telephone','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Telephone'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Telephone'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Telephone'],
            //Video games
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Video games'],
            ['name'=>'accessories', 'type'=>'CheckboxType', 'category'=>'Video games'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Video games'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Video games'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Video games'],
            //DVD Games
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'DVD Games'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'DVD Games'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'DVD Games'],
            //Games accessories
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Games accessories'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Games accessories','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Games accessories'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Games accessories'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Games accessories'],
            //Movies
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Movies'],
            ['name'=>'dvdCd', 'label'=>'DVD CD', 'type'=>'ChoiceType', 'category'=>'Movies','typeOfChoice'=>'TextOptions', 'choice'=>['DVD','CD']],
            ['name'=>'language', 'type'=>'ChoiceType', 'category'=>'Movies','typeOfChoice'=>'TextOptions', 'choice'=>['French','English','German','Italian','Spanish','Ukrainian','Polish','Dutch','Turkish','Romanian','Arabic','Austro-Bavarian','Russian','Hungarian','Greek','Czech','Portuguese','Swedish','Bulgarian','Albanian','Slovak','Chinese','Japanese','Indian','Vietnamese','Persian','Indonesian','Other']],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Movies'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Movies'],

            //Books
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Books'],
            ['name'=>'language', 'type'=>'ChoiceType', 'category'=>'Books','typeOfChoice'=>'TextOptions', 'choice'=>['French','English','German','Italian','Spanish','Ukrainian','Polish','Dutch','Turkish','Romanian','Arabic','Austro-Bavarian','Russian','Hungarian','Greek','Czech','Portuguese','Swedish','Bulgarian','Albanian','Slovak','Chinese','Japanese','Indian','Vietnamese','Persian','Indonesian','Other']],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Books'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Books'],
            //media_Other
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'media_Other'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'media_Other'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'media_Other'],



            //informations--------------------------------------------------------------------------
            // Computer
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Computer'],
            ['name'=>'processor', 'type'=>'TextType', 'category'=>'Computer'],
            ['name'=>'minCapacity', 'label'=>'MIN HDD capacity (gb)','type'=>'ChoiceType', 'category'=>'Computer','typeOfChoice'=>'NumericOptions', 'choice'=>[0,60,100,120,160,200,250,300,500,720,750,800,1000,2000,3000,4000,8000]],
            ['name'=>'maxCapacity', 'label'=>'MAX HDD capacity (gb)','type'=>'ChoiceType', 'category'=>'Computer','typeOfChoice'=>'NumericOptions', 'choice'=>[60,100,120,160,200,250,300,500,720,750,800,1000,2000,3000,4000,8000]],
            ['name'=>'ram', 'label'=>'MIN Ram capacity (gb)','type'=>'ChoiceType', 'category'=>'Computer','typeOfChoice'=>'NumericOptions', 'choice'=>[1,2,3,4,6,8,12,16,24,32,64]],
            ['name'=>'screenSizeCm', 'type'=>'TextType', 'category'=>'Computer'],
            ['name'=>'screenSizeInch', 'type'=>'TextType', 'category'=>'Computer'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Computer','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Computer'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Computer'],
            // laptop
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'laptop'],
            ['name'=>'processor', 'type'=>'TextType', 'category'=>'laptop'],
            ['name'=>'minCapacity', 'label'=>'MIN HDD capacity (gb)','type'=>'ChoiceType', 'category'=>'laptop','typeOfChoice'=>'NumericOptions', 'choice'=>[0,60,100,120,160,200,250,300,500,720,750,800,1000,2000,3000,4000,8000]],
            ['name'=>'maxCapacity', 'label'=>'MAX HDD capacity (gb)','type'=>'ChoiceType', 'category'=>'laptop','typeOfChoice'=>'NumericOptions', 'choice'=>[60,100,120,160,200,250,300,500,720,750,800,1000,2000,3000,4000,8000]],
            ['name'=>'ram', 'label'=>'MIN Ram capacity (gb)','type'=>'ChoiceType', 'category'=>'laptop','typeOfChoice'=>'NumericOptions', 'choice'=>[1,2,3,4,6,8,12,16,24,32,64]],
            ['name'=>'screenSizeCm', 'type'=>'TextType', 'category'=>'laptop'],
            ['name'=>'screenSizeInch', 'type'=>'TextType', 'category'=>'laptop'],
            ['name'=>'hdmi', 'type'=>'CheckboxType', 'category'=>'laptop'],
            ['name'=>'cdRoom', 'type'=>'CheckboxType', 'category'=>'laptop'],
            ['name'=>'accessories', 'type'=>'CheckboxType', 'category'=>'laptop'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'laptop'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'laptop','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'laptop'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'laptop'],
            // Tablet
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Tablet'],
            ['name'=>'minCapacity', 'label'=>'MIN SSD capacity (gb)','type'=>'ChoiceType', 'category'=>'Tablet','typeOfChoice'=>'NumericOptions', 'choice'=>[0,4,8,12,16,32,64,128,256,512,1024]],
            ['name'=>'maxCapacity', 'label'=>'MAX SSD capacity (gb)','type'=>'ChoiceType', 'category'=>'Tablet','typeOfChoice'=>'NumericOptions', 'choice'=>[4,8,12,16,32,64,128,256,512,1024]],
            ['name'=>'ram', 'label'=>'MIN Ram capacity (gb)','type'=>'ChoiceType', 'category'=>'Tablet','typeOfChoice'=>'NumericOptions', 'choice'=>[0.5,1,2,3,4,6,8,16]],
            ['name'=>'screenSizeCm', 'type'=>'TextType', 'category'=>'Tablet'],
            ['name'=>'screenSizeInch', 'type'=>'TextType', 'category'=>'Tablet'],
            ['name'=>'accessories', 'type'=>'CheckboxType', 'category'=>'Tablet'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Tablet'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Tablet','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Tablet'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Tablet'],
            // Mobile
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Mobile'],
            ['name'=>'minCapacity', 'label'=>'MIN SSD capacity (gb)','type'=>'ChoiceType', 'category'=>'Mobile','typeOfChoice'=>'NumericOptions', 'choice'=>[0,4,8,12,16,32,64,128,256,512,1024]],
            ['name'=>'maxCapacity', 'label'=>'MAX SSD capacity (gb)','type'=>'ChoiceType', 'category'=>'Mobile','typeOfChoice'=>'NumericOptions', 'choice'=>[4,8,12,16,32,64,128,256,512,1024]],
            ['name'=>'ram', 'label'=>'MIN Ram capacity (gb)','type'=>'ChoiceType', 'category'=>'Mobile','typeOfChoice'=>'NumericOptions', 'choice'=>[0.5,1,2,3,4,6,8,16]],
            ['name'=>'screenSizeCm', 'type'=>'TextType', 'category'=>'Mobile'],
            ['name'=>'screenSizeInch', 'type'=>'TextType', 'category'=>'Mobile'],
            ['name'=>'accessories', 'type'=>'CheckboxType', 'category'=>'Mobile'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Mobile'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Mobile','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Mobile'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Mobile'],
            // Scanner
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Scanner'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Scanner'],
            ['name'=>'wifi', 'type'=>'CheckboxType', 'category'=>'Scanner'],
            ['name'=>'usb', 'type'=>'CheckboxType', 'category'=>'Scanner'],
            ['name'=>'paperSize', 'type'=>'ChoiceType', 'category'=>'Scanner','typeOfChoice'=>'TextOptions', 'choice'=>['4A0' => 1,'2A0' => 2,'A0' => 3,'A1'=>4,'A2'=>5,'A3'=>6,'A4'=>7,'A5'=>8,'A6'=>9,'A7'=>10,'A8'=>11,'A9'=>12,'A10'=>13]],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Scanner','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Scanner'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Scanner'],
            // Printer
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Printer'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Printer'],
            ['name'=>'printingType', 'type'=>'ChoiceType', 'category'=>'Printer','typeOfChoice'=>'TextOptions', 'choice'=>['Inkjet','Laser','Other']],
            ['name'=>'printingColor', 'type'=>'ChoiceType', 'category'=>'Printer','typeOfChoice'=>'TextOptions', 'choice'=>['Black and white','Colored','Other']],
            ['name'=>'wifi', 'type'=>'CheckboxType', 'category'=>'Printer'],
            ['name'=>'usb', 'type'=>'CheckboxType', 'category'=>'Printer'],
            ['name'=>'threeInOne', 'type'=>'CheckboxType', 'category'=>'Printer'],
            ['name'=>'paperSize', 'type'=>'ChoiceType', 'category'=>'Printer','typeOfChoice'=>'TextOptions', 'choice'=>['4A0' => 1,'2A0' => 2,'A0' => 3,'A1'=>4,'A2'=>5,'A3'=>6,'A4'=>7,'A5'=>8,'A6'=>9,'A7'=>10,'A8'=>11,'A9'=>12,'A10'=>13]],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Printer','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Printer'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Printer'],
            // Monitor
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Monitor'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Monitor'],
            ['name'=>'hdmi', 'type'=>'CheckboxType', 'category'=>'Monitor'],
            ['name'=>'usb', 'type'=>'CheckboxType', 'category'=>'Monitor'],
            ['name'=>'screenSizeCm', 'type'=>'TextType', 'category'=>'Monitor'],
            ['name'=>'screenSizeInch', 'type'=>'TextType', 'category'=>'Monitor'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Monitor','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Monitor'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Monitor'],
            // information_mouse
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'information_mouse'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'information_mouse'],
            ['name'=>'wifi', 'type'=>'CheckboxType', 'category'=>'information_mouse'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'information_mouse','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'information_mouse'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'information_mouse'],
            // keyboard
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'keyboard'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'keyboard'],
            ['name'=>'languages', 'type'=>'ChoiceType', 'category'=>'keyboard','typeOfChoice'=>'TextOptions', 'choice'=>['English','German','Italian','Spanish','Ukrainian','Polish','Dutch','Turkish','Romanian','Arabic','Austro-Bavarian','Russian','Hungarian','Greek','Czech','Portuguese','Swedish','Bulgarian','Albanian','Slovak','Chinese','Japanese','Indian','Vietnamese','Persian','Indonesian']],
            ['name'=>'wifi', 'type'=>'CheckboxType', 'category'=>'keyboard'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'keyboard','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'keyboard'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'keyboard'],
            // Speaker
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Speaker'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Speaker'],
            ['name'=>'capacity','label'=>'MIN Power (watt)', 'type'=>'TextType', 'category'=>'Speaker'],
            ['name'=>'wifi', 'type'=>'CheckboxType', 'category'=>'Speaker'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Speaker','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Speaker'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Speaker'],
            // Hard disk
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Hard disk'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Hard disk'],
            ['name'=>'minCapacity', 'label'=>'MIN HDD capacity (gb)','type'=>'ChoiceType', 'category'=>'Hard disk','typeOfChoice'=>'NumericOptions', 'choice'=>[0,60,100,120,160,200,250,300,500,720,750,800,1000,2000,3000,4000,8000]],
            ['name'=>'maxCapacity', 'label'=>'MAX HDD Capacity (gb)','type'=>'ChoiceType', 'category'=>'Hard disk','typeOfChoice'=>'NumericOptions', 'choice'=>[60,100,120,160,200,250,300,500,720,750,800,1000,2000,3000,4000,8000]],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Hard disk','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Hard disk'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Hard disk'],

            // information_Other
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'information_Other'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'information_Other'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'information_Other'],



            //fashions-------------------------------------------------------------------------------------------------
            // T-shirt
            ['name'=>'sSize', 'label'=>'Size','type'=>'ChoiceType', 'category'=>'T-shirt','typeOfChoice'=>'TextOptions', 'choice'=>['XS','S','M','L','XL','XXL','XXXL']],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'T-shirt','typeOfChoice'=>'TextOptions', 'choice'=>['Wool','Cotton','Linen','Leather','Polyster','Cloth','jeans','Other']],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'T-shirt'],
            ['name'=>'theType', 'type'=>'ChoiceType', 'category'=>'T-shirt','typeOfChoice'=>'TextOptions', 'choice'=>['Men','Women']],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'T-shirt'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'T-shirt'],
            // Shirt
            ['name'=>'sSize', 'label'=>'Size','type'=>'ChoiceType', 'category'=>'Shirt','typeOfChoice'=>'TextOptions', 'choice'=>['XS','S','M','L','XL','XXL','XXXL']],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Shirt','typeOfChoice'=>'TextOptions', 'choice'=>['Wool','Cotton','Linen','Leather','Polyster','Cloth','jeans','Other']],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Shirt'],
            ['name'=>'theType', 'type'=>'ChoiceType', 'category'=>'Shirt','typeOfChoice'=>'TextOptions', 'choice'=>['Men','Women']],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Shirt'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Shirt'],
            // Trouser
            ['name'=>'iSize', 'label'=>'Size','type'=>'ChoiceType', 'category'=>'Trouser','typeOfChoice'=>'NumericOptions', 'choice'=>[32,34,36,38,40,41,42,43,44,45,46,47,48,50,52,54,56,58,60,62]],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Trouser','typeOfChoice'=>'TextOptions', 'choice'=>['Wool','Cotton','Linen','Leather','Polyster','Cloth','Other']],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Trouser'],
            ['name'=>'theType', 'type'=>'ChoiceType', 'category'=>'Trouser','typeOfChoice'=>'TextOptions', 'choice'=>['Men','Women']],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Trouser'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Trouser'],
            // Short
            ['name'=>'iSize', 'label'=>'Size','type'=>'ChoiceType', 'category'=>'Short','typeOfChoice'=>'NumericOptions', 'choice'=>[32,34,36,38,40,41,42,43,44,45,46,47,48,50,52,54,56,58,60,62]],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Short','typeOfChoice'=>'TextOptions', 'choice'=>['Wool','Cotton','Linen','Leather','Polyster','Cloth','Other']],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Short'],
            ['name'=>'theType', 'type'=>'ChoiceType', 'category'=>'Short','typeOfChoice'=>'TextOptions', 'choice'=>['Men','Women']],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Short'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Short'],
            // Costume
            ['name'=>'sSize', 'label'=>'Size','type'=>'ChoiceType', 'category'=>'Costume','typeOfChoice'=>'TextOptions', 'choice'=>['XS','S','M','L','XL','XXL','XXXL']],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Costume','typeOfChoice'=>'TextOptions', 'choice'=>['Wool','Cotton','Linen','Leather','Polyster','Cloth','Other']],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Costume'],
            ['name'=>'theType', 'type'=>'ChoiceType', 'category'=>'Costume','typeOfChoice'=>'TextOptions', 'choice'=>['Men','Women']],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Costume'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Costume'],
            // Dress
            ['name'=>'sSize', 'label'=>'Size','type'=>'ChoiceType', 'category'=>'Dress','typeOfChoice'=>'TextOptions', 'choice'=>['XS','S','M','L','XL','XXL','XXXL']],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Dress','typeOfChoice'=>'TextOptions', 'choice'=>['Felt','Hessian','chiffon','Velours','Denim','Mousseline','Popeline','Charmeuse','Taffeta','Habutai','Other']],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Dress'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Dress'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Dress'],
            // Wedding dress
            ['name'=>'sSize', 'label'=>'Size','type'=>'ChoiceType', 'category'=>'Wedding dress','typeOfChoice'=>'TextOptions', 'choice'=>['XS','S','M','L','XL','XXL','XXXL']],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Wedding dress','typeOfChoice'=>'TextOptions', 'choice'=>['Satin','Charmeuse','Chiffon','Organza','Tulle','Lace','mikado','radzmir','gazar','Other']],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Wedding dress'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Wedding dress'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Wedding dress'],
            // Jacket
            ['name'=>'sSize', 'label'=>'Size','type'=>'ChoiceType', 'category'=>'Jacket','typeOfChoice'=>'TextOptions', 'choice'=>['XS','S','M','L','XL','XXL','XXXL']],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Jacket','typeOfChoice'=>'TextOptions', 'choice'=>['Wool','Cotton','Linen','Leather','Polyster','Polyurethane','Fleece','Nylon','Cashmere','Shearling','Other']],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Jacket'],
            ['name'=>'theType', 'type'=>'ChoiceType', 'category'=>'Jacket','typeOfChoice'=>'TextOptions', 'choice'=>['Men','Women']],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Jacket'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Jacket'],
            // Langerie
            ['name'=>'sSize', 'label'=>'Size','type'=>'ChoiceType', 'category'=>'Langerie','typeOfChoice'=>'TextOptions', 'choice'=>['XS','S','M','L','XL','XXL','XXXL']],
            ['name'=>'material', 'type'=>'TextType', 'category'=>'Langerie'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Langerie'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Langerie'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Langerie'],
            // Shoe
            ['name'=>'iSize', 'label'=>'Size','type'=>'ChoiceType', 'category'=>'Shoe','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>36,'max'=>48]],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Shoe','typeOfChoice'=>'TextOptions', 'choice'=>['Leather','Textiles','Synthetics','Rubber','Polyster','Foam','Other']],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Shoe'],
            ['name'=>'theType', 'type'=>'ChoiceType', 'category'=>'Shoe','typeOfChoice'=>'TextOptions', 'choice'=>['Men','Women']],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Shoe'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Shoe'],
            // Slide sandal
            ['name'=>'iSize', 'label'=>'Size','type'=>'ChoiceType', 'category'=>'Slide sandal','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>36,'max'=>48]],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Slide sandal','typeOfChoice'=>'TextOptions', 'choice'=>['Leather','Textiles','Synthetics','Rubber','Polyster','Foam','Other']],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Slide sandal'],
            ['name'=>'theType', 'type'=>'ChoiceType', 'category'=>'Slide sandal','typeOfChoice'=>'TextOptions', 'choice'=>['Men','Women']],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Slide sandal'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Slide sandal'],
            // Athletic shoe
            ['name'=>'iSize', 'label'=>'Size','type'=>'ChoiceType', 'category'=>'Athletic shoe','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>36,'max'=>48]],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Athletic shoe','typeOfChoice'=>'TextOptions', 'choice'=>['Leather','Textiles','Synthetics','Rubber','Polyster','Foam','Other']],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Athletic shoe'],
            ['name'=>'theType', 'type'=>'ChoiceType', 'category'=>'Athletic shoe','typeOfChoice'=>'TextOptions', 'choice'=>['Men','Women']],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Athletic shoe'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Athletic shoe'],
            // fashion_Other
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'fashion_Other'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'fashion_Other'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'fashion_Other'],



            //homeAppliances-------------------------------------------------------------------------------------------
            //Refrigerator
            ['name'=>'capacity', 'label'=>'MIN Capacity (liter)','type'=>'ChoiceType', 'category'=>'Refrigerator','typeOfChoice'=>'TextOptions', 'choice'=>['Less than 50 Liters'=> 1,'50-80 Liters'=> 2,'80-150 Liters'=> 3,'150-250 Liters'=> 4,'250-330 Liters'=>5,'330-490 Liters'=> 6,'More than 50 Liters'=>7]],
            ['name'=>'withFreezer', 'type'=>'CheckboxType', 'category'=>'Refrigerator'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Refrigerator'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Refrigerator'],

            //Cookers gas
            ['name'=>'fuelType','type'=>'ChoiceType', 'category'=>'Cookers gas','typeOfChoice'=>'TextOptions', 'choice'=>['City gas','Bottle gas']],
            ['name'=>'numberOfHead','type'=>'ChoiceType', 'category'=>'Cookers gas','typeOfChoice'=>'NumericOptions', 'choice'=>[1,2,3,4,5,6,7,8]],
            ['name'=>'withOven', 'type'=>'CheckboxType', 'category'=>'Cookers gas'],
            ['name'=>'electricHead', 'type'=>'CheckboxType', 'category'=>'Cookers gas'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Cookers gas'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Cookers gas'],
            //Cookers electric
            ['name'=>'numberOfHead','type'=>'ChoiceType', 'category'=>'Cookers electric','typeOfChoice'=>'NumericOptions', 'choice'=>[1,2,3,4,5,6,7,8]],
            ['name'=>'withOven', 'type'=>'CheckboxType', 'category'=>'Cookers electric'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Cookers electric'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Cookers electric'],
            //Gas plate
            ['name'=>'numberOfHead','type'=>'ChoiceType', 'category'=>'Gas plate','typeOfChoice'=>'NumericOptions', 'choice'=>[1,2,3,4,5,6,7,8]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Gas plate'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Gas plate'],
            //Washing machine
            ['name'=>'capacity', 'label'=>'MIN Capacity (kg)','type'=>'ChoiceType', 'category'=>'Washing machine','typeOfChoice'=>'NumericOptions', 'choice'=>[3,4,5,6,7,8,9,10,12]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Washing machine'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Washing machine'],
            //Fan
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Fan'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Fan'],
            //Coffee machine
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Coffee machine'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Coffee machine'],
            //Electric kettle
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Electric kettle'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Electric kettle'],
            //Vaccuum cleaner
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Vaccuum cleaner'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Vaccuum cleaner'],
            //Oven
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Oven'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Oven'],
            //Blender
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Blender'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Blender'],
            //Stand Mixer
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Stand Mixer'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Stand Mixer'],
            //Dishwashers
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Dishwashers'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Dishwashers'],
            //Electric fryer
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Electric fryer'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Electric fryer'],
            //Freezer
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Freezer'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Freezer'],
            //Pressure cooker
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Pressure cooker'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Pressure cooker'],
            //Heater
            ['name'=>'fuelType', 'type'=>'ChoiceType', 'category'=>'Heater','typeOfChoice'=>'TextOptions', 'choice'=>['Gas','Diesel','fuelwood','Electric','Other']],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Heater'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Heater'],
            //Iron
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Iron'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Iron'],
            //Men's shaver
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Men\'s shaver'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Men\'s shaver'],
            //Lady shavers
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Lady shavers'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Lady shavers'],
            //Sandwich toaster
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Sandwich toaster'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Sandwich toaster'],
            //Meat grinder
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Meat grinder'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Meat grinder'],
            //Grilling charcoal
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Grilling charcoal'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Grilling charcoal'],
            //Hair dryer
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Hair dryer'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Hair dryer'],
            //Juicer machine
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Juicer machine'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Juicer machine'],
            //Electric vegetable
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Electric vegetable'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Electric vegetable'],
            //Kitchen accessories
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Kitchen accessories'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Kitchen accessories'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Kitchen accessories'],
            //home_Other
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'home_Other'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'home_Other'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'home_Other'],



            //gardens--------------------------------------------------------------------------------------------------
            // Garden table
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Garden table','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Other']],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Garden table'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Garden table'],
            // Swing
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Swing','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Other']],
            ['name'=>'numberOfPersson', 'label'=>'MIN Number of persson','type'=>'ChoiceType', 'category'=>'Swing','typeOfChoice'=>'NumericOptions', 'choice'=>[1,2,3,4,5,6,7,8]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Swing'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Swing'],
            // Seedlings
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Seedlings'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Seedlings'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Seedlings'],
            // Garden chair
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Garden chair','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Other']],
            ['name'=>'number', 'label'=>'MIN Number (unit)','type'=>'ChoiceType', 'category'=>'Garden chair','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>50]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Garden chair'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Garden chair'],
            // Lawn mower
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Lawn mower'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Lawn mower'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Lawn mower'],
            // Chainsaw
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Chainsaw'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Chainsaw'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Chainsaw'],
            // Garden tools
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Garden tools'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Garden tools'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Garden tools'],
            // Fuelwood
            ['name'=>'material', 'type'=>'TextType', 'category'=>'Fuelwood'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Fuelwood'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Fuelwood'],
            // Electric generator
            ['name'=>'capacity', 'label'=>'MIN Power (watt)', 'type'=>'TextType', 'category'=>'Electric generator'],
            ['name'=>'fuelType', 'type'=>'ChoiceType', 'category'=>'Electric generator','typeOfChoice'=>'TextOptions', 'choice'=>['Diesel','Gasoline','Gas','Other']],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Electric generator'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Electric generator'],
            // garden_Other
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'garden_Other'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'garden_Other'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'garden_Other'],





            //residences------------------------------------------------------------------------------------------------
            // Sell house cm²
            ['name'=>'withFurniture', 'type'=>'CheckboxType', 'category'=>'Sell house'],
            ['name'=>'withGarden', 'type'=>'CheckboxType', 'category'=>'Sell house'],
            ['name'=>'city', 'type'=>'EntityType', 'category'=>'Sell house'],
            ['name'=>'minArea','label'=>'MIN Area (m²)', 'type'=>'ChoiceType', 'category'=>'Sell house','typeOfChoice'=>'NumericOptions', 'choice'=>[0,50,60,70,80,90,100,110,120,150,200,250,300]],
            ['name'=>'maxArea','label'=>'MAX Area (m²)', 'type'=>'ChoiceType', 'category'=>'Sell house','typeOfChoice'=>'NumericOptions', 'choice'=>[50,60,70,80,90,100,110,120,150,200,250,300,400]],
            ['name'=>'numberOfRooms', 'label'=>'MIN Number of rooms','type'=>'ChoiceType', 'category'=>'Sell house','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>12]],
            ['name'=>'heatingType', 'type'=>'ChoiceType', 'category'=>'Sell house','typeOfChoice'=>'TextOptions', 'choice'=>['Diesel','Electricity','Fuelwood','Gas','Other']],
            ['name'=>'classEnergie', 'label'=>'Class energie MAX', 'type'=>'ChoiceType', 'category'=>'Sell house','typeOfChoice'=>'TextOptions', 'choice'=>['A'=> 1,'B'=> 2,'C' => 3,'D' => 4,'E'=>5,'F'=>6,'G'=>7]],
            ['name'=>'ges', 'label'=>'GES MAX', 'type'=>'ChoiceType', 'category'=>'Sell house','typeOfChoice'=>'TextOptions', 'choice'=>['A'=> 1,'B'=> 2,'C' => 3,'D' => 4,'E'=>5,'F'=>6,'G'=>7]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Sell house'],

            // Sell apartment
            ['name'=>'withFurniture', 'type'=>'CheckboxType', 'category'=>'Sell apartment'],
            ['name'=>'withVerandah', 'type'=>'CheckboxType', 'category'=>'Sell apartment'],
            ['name'=>'withElevator', 'type'=>'CheckboxType', 'category'=>'Sell apartment'],
            ['name'=>'city', 'type'=>'EntityType', 'category'=>'Sell apartment'],
            ['name'=>'minArea','label'=>'MIN Area (m²)', 'type'=>'ChoiceType', 'category'=>'Sell apartment','typeOfChoice'=>'NumericOptions', 'choice'=>[0,7,15,20,25,30,35,40,50,60,70,80,90,100,110,120,150,200,250]],
            ['name'=>'maxArea','label'=>'MAX Area (m²)', 'type'=>'ChoiceType', 'category'=>'Sell apartment','typeOfChoice'=>'NumericOptions', 'choice'=>[7,15,20,25,30,35,40,50,60,70,80,90,100,110,120,150,200,250,300]],
            ['name'=>'numberOfRooms', 'label'=>'MIN Number of rooms','type'=>'ChoiceType', 'category'=>'Sell apartment','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>12]],
            ['name'=>'heatingType', 'type'=>'ChoiceType', 'category'=>'Sell apartment','typeOfChoice'=>'TextOptions', 'choice'=>['Diesel','Electricity','Fuelwood','Gas','Other']],
            ['name'=>'heating', 'type'=>'ChoiceType', 'category'=>'Sell apartment','typeOfChoice'=>'TextOptions', 'choice'=>['Individually','Collective','Other']],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Sell apartment'],

            // Sell office
            ['name'=>'withFurniture', 'type'=>'CheckboxType', 'category'=>'Sell office'],
            ['name'=>'withElevator', 'type'=>'CheckboxType', 'category'=>'Sell office'],
            ['name'=>'city', 'type'=>'EntityType', 'category'=>'Sell office'],
            ['name'=>'minArea','label'=>'MIN Area (m²)', 'type'=>'ChoiceType', 'category'=>'Sell office','typeOfChoice'=>'NumericOptions', 'choice'=>[0,15,20,25,30,35,40,50,60,70,80,90,100,110,120,150,200,250]],
            ['name'=>'maxArea','label'=>'MAX Area (m²)', 'type'=>'ChoiceType', 'category'=>'Sell office','typeOfChoice'=>'NumericOptions', 'choice'=>[15,20,25,30,35,40,50,60,70,80,90,100,110,120,150,200,250,300]],
            ['name'=>'numberOfRooms', 'label'=>'MIN Number of rooms','type'=>'ChoiceType', 'category'=>'Sell office','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>12]],
            ['name'=>'heatingType', 'type'=>'ChoiceType', 'category'=>'Sell office','typeOfChoice'=>'TextOptions', 'choice'=>['Diesel','Electricity','Fuelwood','Gas','Other']],
            ['name'=>'heating', 'type'=>'ChoiceType', 'category'=>'Sell office','typeOfChoice'=>'TextOptions', 'choice'=>['Individually','Collective','Other']],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Sell office'],

            // Sell shop
            ['name'=>'city', 'type'=>'EntityType', 'category'=>'Sell shop'],
            ['name'=>'minArea','label'=>'MIN Area (m²)', 'type'=>'ChoiceType', 'category'=>'Sell shop','typeOfChoice'=>'NumericOptions', 'choice'=>[0,7,15,20,25,30,35,40,50,60,70,80,90,100,110,120,150,200,250]],
            ['name'=>'maxArea','label'=>'MAX Area (m²)', 'type'=>'ChoiceType', 'category'=>'Sell shop','typeOfChoice'=>'NumericOptions', 'choice'=>[7,15,20,25,30,35,40,50,60,70,80,90,100,110,120,150,200,250,300]],
            ['name'=>'heatingType', 'type'=>'ChoiceType', 'category'=>'Sell shop','typeOfChoice'=>'TextOptions', 'choice'=>['Diesel','Electricity','Gas','Other']],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Sell shop'],

            // Sell car parking
            ['name'=>'city', 'type'=>'EntityType', 'category'=>'Sell car parking'],
            ['name'=>'covered', 'type'=>'CheckboxType', 'category'=>'Sell car parking'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Sell car parking'],

            // Sell farm
            ['name'=>'city', 'type'=>'EntityType', 'category'=>'Sell farm'],
            ['name'=>'minArea','label'=>'MIN Area (m²)', 'type'=>'ChoiceType', 'category'=>'Sell farm','typeOfChoice'=>'NumericOptions', 'choice'=>[0,100,150,200,250,300,350,400,450,500,700,900,1000,1200,1500,2000,3000,4000,5000]],
            ['name'=>'maxArea','label'=>'MAX Area (m²)', 'type'=>'ChoiceType', 'category'=>'Sell farm','typeOfChoice'=>'NumericOptions', 'choice'=>[100,150,200,250,300,350,400,450,500,700,900,1000,1200,1500,2000,3000,4000,5000,10000]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Sell farm'],

            // Rent house
            ['name'=>'withFurniture', 'type'=>'CheckboxType', 'category'=>'Rent house'],
            ['name'=>'withGarden', 'type'=>'CheckboxType', 'category'=>'Rent house'],
            ['name'=>'city', 'type'=>'EntityType', 'category'=>'Rent house'],
            ['name'=>'minArea','label'=>'MIN Area (m²)', 'type'=>'ChoiceType', 'category'=>'Rent house','typeOfChoice'=>'NumericOptions', 'choice'=>[0,50,60,70,80,90,100,110,120,150,200,250,300]],
            ['name'=>'maxArea','label'=>'MAX Area (m²)', 'type'=>'ChoiceType', 'category'=>'Rent house','typeOfChoice'=>'NumericOptions', 'choice'=>[50,60,70,80,90,100,110,120,150,200,250,300,400]],
            ['name'=>'numberOfRooms', 'label'=>'MIN Number of rooms','type'=>'ChoiceType', 'category'=>'Rent house','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>12]],
            ['name'=>'heatingType', 'type'=>'ChoiceType', 'category'=>'Rent house','typeOfChoice'=>'TextOptions', 'choice'=>['Diesel','Electricity','Fuelwood','Gas','Other']],
            ['name'=>'classEnergie', 'label'=>'Class energie MAX', 'type'=>'ChoiceType', 'category'=>'Rent house','typeOfChoice'=>'TextOptions', 'choice'=>['A'=> 1,'B'=> 2,'C' => 3,'D' => 4,'E'=>5,'F'=>6,'G'=>7]],
            ['name'=>'ges', 'label'=>'GES MAX', 'type'=>'ChoiceType', 'category'=>'Rent house','typeOfChoice'=>'TextOptions', 'choice'=>['A'=> 1,'B'=> 2,'C' => 3,'D' => 4,'E'=>5,'F'=>6,'G'=>7]],
            ['name'=>'price','label'=>'Rent MAX', 'type'=>'TextType', 'category'=>'Rent house'],
            // Rent apartment
            ['name'=>'withFurniture', 'type'=>'CheckboxType', 'category'=>'Rent apartment'],
            ['name'=>'withVerandah', 'type'=>'CheckboxType', 'category'=>'Rent apartment'],
            ['name'=>'withElevator', 'type'=>'CheckboxType', 'category'=>'Rent apartment'],
            ['name'=>'city', 'type'=>'EntityType', 'category'=>'Rent apartment'],
            ['name'=>'minArea','label'=>'MIN Area (m²)', 'type'=>'ChoiceType', 'category'=>'Rent apartment','typeOfChoice'=>'NumericOptions', 'choice'=>[0,7,15,20,25,30,35,40,50,60,70,80,90,100,110,120,150,200,250]],
            ['name'=>'maxArea','label'=>'MAX Area (m²)', 'type'=>'ChoiceType', 'category'=>'Rent apartment','typeOfChoice'=>'NumericOptions', 'choice'=>[7,15,20,25,30,35,40,50,60,70,80,90,100,110,120,150,200,250,300]],
            ['name'=>'numberOfRooms', 'label'=>'MIN Number of rooms','type'=>'ChoiceType', 'category'=>'Rent apartment','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>12]],
            ['name'=>'heatingType', 'type'=>'ChoiceType', 'category'=>'Rent apartment','typeOfChoice'=>'TextOptions', 'choice'=>['Diesel','Electricity','Fuelwood','Gas','Other']],
            ['name'=>'heating', 'type'=>'ChoiceType', 'category'=>'Rent apartment','typeOfChoice'=>'TextOptions', 'choice'=>['Individually','Collective','Other']],
            ['name'=>'price', 'label'=>'Rent MAX', 'type'=>'TextType', 'category'=>'Rent apartment'],

            // Office rental
            ['name'=>'withElevator', 'type'=>'CheckboxType', 'category'=>'Office rental'],
            ['name'=>'city', 'type'=>'EntityType', 'category'=>'Office rental'],
            ['name'=>'minArea','label'=>'MIN Area (m²)', 'type'=>'ChoiceType', 'category'=>'Office rental','typeOfChoice'=>'NumericOptions', 'choice'=>[0,15,20,25,30,35,40,50,60,70,80,90,100,110,120,150,200,250]],
            ['name'=>'maxArea','label'=>'MAX Area (m²)', 'type'=>'ChoiceType', 'category'=>'Office rental','typeOfChoice'=>'NumericOptions', 'choice'=>[15,20,25,30,35,40,50,60,70,80,90,100,110,120,150,200,250,300]],
            ['name'=>'numberOfRooms', 'label'=>'MIN Number of rooms','type'=>'ChoiceType', 'category'=>'Office rental','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>12]],
            ['name'=>'heatingType', 'type'=>'ChoiceType', 'category'=>'Office rental','typeOfChoice'=>'TextOptions', 'choice'=>['Diesel','Electricity','Fuelwood','Gas','Other']],
            ['name'=>'heating', 'type'=>'ChoiceType', 'category'=>'Office rental','typeOfChoice'=>'TextOptions', 'choice'=>['Individually','Collective','Other']],
            ['name'=>'floor','type'=>'ChoiceType', 'category'=>'Office rental','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>0,'max'=>50]],
            ['name'=>'numberOfFloors','label'=>'Floors in the building','type'=>'ChoiceType', 'category'=>'Office rental','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>0,'max'=>50]],
            ['name'=>'price','label'=>'Rent MAX', 'type'=>'TextType', 'category'=>'Office rental'],

            // Rent shop
            ['name'=>'city', 'type'=>'EntityType', 'category'=>'Rent shop'],
            ['name'=>'minArea','label'=>'MIN Area (m²)', 'type'=>'ChoiceType', 'category'=>'Rent shop','typeOfChoice'=>'NumericOptions', 'choice'=>[0,7,15,20,25,30,35,40,50,60,70,80,90,100,110,120,150,200,250]],
            ['name'=>'maxArea','label'=>'MAX Area (m²)', 'type'=>'ChoiceType', 'category'=>'Rent shop','typeOfChoice'=>'NumericOptions', 'choice'=>[7,15,20,25,30,35,40,50,60,70,80,90,100,110,120,150,200,250,300]],
            ['name'=>'heatingType', 'type'=>'ChoiceType', 'category'=>'Rent shop','typeOfChoice'=>'TextOptions', 'choice'=>['Diesel','Electricity','Gas','Other']],
            ['name'=>'price', 'label'=>'Rent MAX', 'type'=>'TextType', 'category'=>'Rent shop'],

            // Rent car parking
            ['name'=>'city', 'type'=>'EntityType', 'category'=>'Rent car parking'],
            ['name'=>'covered', 'type'=>'CheckboxType', 'category'=>'Rent car parking'],
            ['name'=>'price','label'=>'Rent MAX', 'type'=>'TextType', 'category'=>'Rent car parking'],

            // Rent farm
            ['name'=>'city', 'type'=>'EntityType', 'category'=>'Rent farm'],
            ['name'=>'minArea','label'=>'MIN Area (m²)', 'type'=>'ChoiceType', 'category'=>'Rent farm','typeOfChoice'=>'NumericOptions', 'choice'=>[0,100,150,200,250,300,350,400,450,500,700,900,1000,1200,1500,2000,3000,4000,5000]],
            ['name'=>'maxArea','label'=>'MAX Area (m²)', 'type'=>'ChoiceType', 'category'=>'Rent farm','typeOfChoice'=>'NumericOptions', 'choice'=>[100,150,200,250,300,350,400,450,500,700,900,1000,1200,1500,2000,3000,4000,5000,10000]],
            ['name'=>'price','label'=>'Rent MAX', 'type'=>'TextType', 'category'=>'Rent farm'],

            // Collective housing
            ['name'=>'theType', 'type'=>'ChoiceType', 'category'=>'Collective housing','typeOfChoice'=>'TextOptions', 'choice'=>['House','Apartment','Residential center','Other']],
            ['name'=>'withFurniture', 'type'=>'CheckboxType', 'category'=>'Collective housing'],
            ['name'=>'withElevator', 'type'=>'CheckboxType', 'category'=>'Collective housing'],
            ['name'=>'city', 'type'=>'EntityType', 'category'=>'Collective housing'],
            ['name'=>'heatingType', 'type'=>'ChoiceType', 'category'=>'Collective housing','typeOfChoice'=>'TextOptions', 'choice'=>['Diesel','Electricity','Fuelwood','Gas','Other']],
            ['name'=>'price','label'=>'Rent MAX', 'type'=>'TextType', 'category'=>'Collective housing'],

            // residence_Other
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'residence_Other'],
            ['name'=>'city', 'type'=>'EntityType', 'category'=>'residence_Other'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'residence_Other'],





            //jewelrys---------------------------------------------------------------------------------------------------
            // Necklaces
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Necklaces','typeOfChoice'=>'TextOptions', 'choice'=>['Silver','Silver filled','Yellow gold','White gold','Rose gold','Green gold','Base Metal','Platinum','Titanium','gemstone','mixed','Other']],
            ['name'=>'weight', 'label'=>'MAX Weight (g)', 'type'=>'TextType', 'category'=>'Necklaces'],
            ['name'=>'caliber', 'type'=>'TextType', 'category'=>'Necklaces'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Necklaces'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Necklaces'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Necklaces'],
            // Collier
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Collier','typeOfChoice'=>'TextOptions', 'choice'=>['Silver','Silver filled','Yellow gold','White gold','Rose gold','Green gold','Base Metal','Platinum','Titanium','gemstone','mixed','Other']],
            ['name'=>'weight', 'label'=>'MAX Weight (g)', 'type'=>'TextType', 'category'=>'Collier'],
            ['name'=>'caliber', 'type'=>'TextType', 'category'=>'Collier'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Collier'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Collier'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Collier'],
            // Bracelet
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Bracelet','typeOfChoice'=>'TextOptions', 'choice'=>['Silver','Silver filled','Yellow gold','White gold','Rose gold','Green gold','Base Metal','Platinum','Titanium','gemstone','mixed','Other']],
            ['name'=>'weight', 'label'=>'MAX Weight (g)', 'type'=>'TextType', 'category'=>'Bracelet'],
            ['name'=>'caliber', 'type'=>'TextType', 'category'=>'Bracelet'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Bracelet'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Bracelet'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Bracelet'],
            // Ring
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Ring','typeOfChoice'=>'TextOptions', 'choice'=>['Silver','Silver filled','Yellow gold','White gold','Rose gold','Green gold','Base Metal','Platinum','Titanium','gemstone','mixed','Other']],
            ['name'=>'weight', 'label'=>'MAX Weight (g)', 'type'=>'TextType', 'category'=>'Ring'],
            ['name'=>'caliber', 'type'=>'TextType', 'category'=>'Ring'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Ring'],
            ['name'=>'iSize', 'label'=>'Size Of Ring','type'=>'ChoiceType', 'category'=>'Ring','typeOfChoice'=>'NumericOptions', 'choice'=>[45,47,50,53,57,60,63,66,69]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Ring'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Ring'],
            // Watch
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Watch'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Watch'],
            ['name'=>'analogDigital', 'type'=>'ChoiceType', 'category'=>'Watch','typeOfChoice'=>'TextOptions', 'choice'=>['Analogue','Digital','Other']],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Watch'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Watch'],
            // Earrings
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Earrings','typeOfChoice'=>'TextOptions', 'choice'=>['Silver','Silver filled','Yellow gold','White gold','Rose gold','Green gold','Base Metal','Platinum','Titanium','gemstone','mixed','Other']],
            ['name'=>'weight', 'label'=>'MAX Weight (g)', 'type'=>'TextType', 'category'=>'Earrings'],
            ['name'=>'caliber', 'type'=>'TextType', 'category'=>'Earrings'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Earrings'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Earrings'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Earrings'],
            // Perfumes
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Perfumes'],
            ['name'=>'maxCapacity', 'label'=>'MAX Capacity (ml)', 'type'=>'TextType', 'category'=>'Perfumes'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Perfumes'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Perfumes'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Perfumes'],
            // Wine
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Wine'],
            ['name'=>'capacity', 'label'=>'MIN Capacity (ml)', 'type'=>'ChoiceType', 'category'=>'Wine','typeOfChoice'=>'NumericOptions', 'choice'=>[100,187,375,750,1000,1500,3000]],
            ['name'=>'minManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Wine','choice'=>['min'=>1890,'max'=>$thisYear]],
            ['name'=>'maxManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Wine','choice'=>['min'=>1891,'max'=>$thisYear]],
            ['name'=>'originCountry', 'type'=>'ChoiceType', 'category'=>'Wine','typeOfChoice'=>'TextOptions', 'choice'=>['France','Italy','Spain','Chile','Australia','United States','Germany','New zealand','Portugal','Argentina','Croatia','Switzerland','Other']],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Wine'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Wine'],
            // jewelry_Other
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'jewelry_Other'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'jewelry_Other'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'jewelry_Other'],





            //musics---------------------------------------------------------------------------------------------------
            // Piano
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Piano'],
            ['name'=>'minManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Piano','choice'=>['min'=>1920,'max'=>$thisYear]],
            ['name'=>'maxManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Piano','choice'=>['min'=>1921,'max'=>$thisYear]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Piano'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Piano'],
            // Violin
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Violin'],
            ['name'=>'minManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Violin','choice'=>['min'=>1920,'max'=>$thisYear]],
            ['name'=>'maxManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Violin','choice'=>['min'=>1921,'max'=>$thisYear]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Violin'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Violin'],
            // Trumpet
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Trumpet'],
            ['name'=>'minManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Trumpet','choice'=>['min'=>1920,'max'=>$thisYear]],
            ['name'=>'maxManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Trumpet','choice'=>['min'=>1921,'max'=>$thisYear]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Trumpet'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Trumpet'],
            // Flute
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Flute'],
            ['name'=>'minManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Flute','choice'=>['min'=>1920,'max'=>$thisYear]],
            ['name'=>'maxManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Flute','choice'=>['min'=>1921,'max'=>$thisYear]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Flute'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Flute'],
            // Clarinet
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Clarinet'],
            ['name'=>'minManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Clarinet','choice'=>['min'=>1920,'max'=>$thisYear]],
            ['name'=>'maxManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Clarinet','choice'=>['min'=>1921,'max'=>$thisYear]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Clarinet'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Clarinet'],
            // Drums
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Drums'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Drums'],
            ['name'=>'minManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Drums','choice'=>['min'=>1920,'max'=>$thisYear]],
            ['name'=>'maxManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Drums','choice'=>['min'=>1921,'max'=>$thisYear]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Drums'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Drums'],
            // Cello
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Cello'],
            ['name'=>'minManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Cello','choice'=>['min'=>1920,'max'=>$thisYear]],
            ['name'=>'maxManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Cello','choice'=>['min'=>1921,'max'=>$thisYear]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Cello'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Cello'],
            // Contrabass
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Contrabass'],
            ['name'=>'minManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Contrabass','choice'=>['min'=>1920,'max'=>$thisYear]],
            ['name'=>'maxManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Contrabass','choice'=>['min'=>1921,'max'=>$thisYear]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Contrabass'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Contrabass'],
            // Electric guitar
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Electric guitar'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Electric guitar'],
            ['name'=>'minManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Electric guitar','choice'=>['min'=>1920,'max'=>$thisYear]],
            ['name'=>'maxManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Electric guitar','choice'=>['min'=>1921,'max'=>$thisYear]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Electric guitar'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Electric guitar'],
            // Classic guitar
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Classic guitar'],
            ['name'=>'minManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Classic guitar','choice'=>['min'=>1920,'max'=>$thisYear]],
            ['name'=>'maxManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Classic guitar','choice'=>['min'=>1921,'max'=>$thisYear]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Classic guitar'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Classic guitar'],
            // Digital keyboard
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Digital keyboard'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Digital keyboard'],
            ['name'=>'minManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Digital keyboard','choice'=>['min'=>1940,'max'=>$thisYear]],
            ['name'=>'maxManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Digital keyboard','choice'=>['min'=>1941,'max'=>$thisYear]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Digital keyboard'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Digital keyboard'],
            // Accordion
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Accordion'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Accordion'],
            ['name'=>'minManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Accordion','choice'=>['min'=>1920,'max'=>$thisYear]],
            ['name'=>'maxManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Accordion','choice'=>['min'=>1921,'max'=>$thisYear]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Accordion'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Accordion'],
            // Music accessories
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Music accessories'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Music accessories'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Music accessories'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Music accessories'],
            // music_Other
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'music_Other'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'music_Other'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'music_Other'],



            //sports--------------------------------------------------------------------------------------------------
            // Ski boots
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Ski boots'],
            ['name'=>'iSize', 'label'=>'Size', 'type'=>'ChoiceType', 'category'=>'Ski boots','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>32,'max'=>48]],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Ski boots','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Ski boots'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Ski boots'],
            // Roller skating
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Roller skating'],
            ['name'=>'iSize', 'label'=>'Size', 'type'=>'ChoiceType', 'category'=>'Roller skating','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>32,'max'=>48]],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Roller skating','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Roller skating'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Roller skating'],
            // Parachute
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Parachute'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Parachute'],
            // Swimming glasses
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Swimming glasses'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Swimming glasses'],
            // Football
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Football'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Football'],
            // Basketball
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Basketball'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Basketball'],
            // Iron balls
            ['name'=>'number', 'label'=>'MIN Number (unit)','type'=>'ChoiceType', 'category'=>'Iron balls','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>30]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Iron balls'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Iron balls'],
            // Volley ball
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Volley ball'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Volley ball'],
            // American football
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'American football'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'American football'],
            // Sports tool
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Sports tool'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Sports tool','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Sports tool'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Sports tool'],
            // Bicycle
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Bicycle'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Bicycle'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Bicycle','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Bicycle'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Bicycle'],
            // Bicycle accessories
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Bicycle accessories'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Bicycle accessories','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Bicycle accessories'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Bicycle accessories'],
            // sport_Other
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'sport_Other'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'sport_Other'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'sport_Other'],



            //Pets-----------------------------------------------------------------------------------------------------
            //  Cat
            ['name'=>'age', 'label'=>'MAX Age (year)', 'type'=>'TextType', 'category'=>'Cat'],
            ['name'=>'animalSpecies', 'type'=>'TextType', 'category'=>'Cat'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Cat'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Cat'],
            // Dog
            ['name'=>'age', 'label'=>'MAX Age (year)', 'type'=>'TextType', 'category'=>'Dog'],
            ['name'=>'animalSpecies', 'type'=>'TextType', 'category'=>'Dog'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Dog'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Dog'],
            // Hamster
            ['name'=>'age', 'label'=>'MAX Age (year)', 'type'=>'TextType', 'category'=>'Hamster'],
            ['name'=>'animalSpecies', 'type'=>'TextType', 'category'=>'Hamster'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Hamster'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Hamster'],
            // Mouse
            ['name'=>'age', 'label'=>'MAX Age (year)', 'type'=>'TextType', 'category'=>'Mouse'],
            ['name'=>'animalSpecies', 'type'=>'TextType', 'category'=>'Mouse'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Mouse'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Mouse'],
            // pet_Other
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'pet_Other'],
            ['name'=>'age', 'label'=>'MAX Age (year)', 'type'=>'TextType', 'category'=>'pet_Other'],
            ['name'=>'animalSpecies', 'type'=>'TextType', 'category'=>'pet_Other'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'pet_Other'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'pet_Other'],



            //kids------------------------------------------------------------------------------------------------------
            //  Crib
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Crib','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Other']],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Crib'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Crib'],
            // kids_Chest of drawers

            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'kids_Chest of drawers','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Other']],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'kids_Chest of drawers'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'kids_Chest of drawers'],
            // Stroller
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Stroller'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Stroller'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Stroller'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Stroller'],
            // Diapers
            ['name'=>'iSize', 'label'=>'Size', 'type'=>'ChoiceType', 'category'=>'Diapers','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>0,'max'=>8]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Diapers'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Diapers'],
            // kids_Mattress
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'kids_Mattress'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'kids_Mattress'],
            // Baby clothes
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Baby clothes'],
            ['name'=>'iSize', 'label'=>'Size', 'type'=>'ChoiceType', 'category'=>'Baby clothes','typeOfChoice'=>'NumericOptions', 'choice'=>[40,44,50,54,60,67,71,74,81,86,94,102,108,116,122,128,134,140,146,152,158,164,170,174,180]],
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Baby clothes'],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Baby clothes','typeOfChoice'=>'TextOptions', 'choice'=>['Cotton','Cloth','Polyester','Linen','Jeans','Wool','Silk','Other']],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Baby clothes'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Baby clothes'],
            // Baby tools
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Baby tools'],
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Baby tools'],
            ['name'=>'age', 'type'=>'ChoiceType', 'category'=>'Baby tools','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>15]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Baby tools'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Baby tools'],
            // Baby toys
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Baby toys'],
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Baby toys'],
            ['name'=>'age', 'type'=>'ChoiceType', 'category'=>'Baby toys','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>15]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Baby toys'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Baby toys'],
            // kid_Other
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'kid_Other'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'kid_Other'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'kid_Other'],



            // furnitures-----------------------------------------------------------------------------------------------
            //  Couch
            ['name'=>'numberOfPersson', 'label'=>'MIN Number of persson', 'type'=>'ChoiceType', 'category'=>'Couch','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>5]],
            ['name'=>'coverMaterial', 'type'=>'ChoiceType', 'category'=>'Couch','typeOfChoice'=>'TextOptions', 'choice'=>['Cotton','Cloth','Leather','Linen','Velvet','Chamois','Other']],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Couch'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Couch'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Couch'],
            // Dining table
            ['name'=>'numberOfPersson', 'label'=>'MIN Number of persson', 'type'=>'ChoiceType', 'category'=>'Dining table','typeOfChoice'=>'NumericOptions', 'choice'=>[2,4,6,8,10,12,14]],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Dining table','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Other']],
            ['name'=>'shape', 'type'=>'ChoiceType', 'category'=>'Dining table','typeOfChoice'=>'TextOptions', 'choice'=>['Oval','Circular','Square','Rectangle','Complex','Other']],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Dining table'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Dining table'],
            // Chest of drawers
            ['name'=>'numberOfDrawer', 'label'=>'MIN Number of drawer', 'type'=>'ChoiceType', 'category'=>'Chest of drawers','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>12]],
            ['name'=>'numberOfStaging', 'label'=>'MIN Number of staging', 'type'=>'ChoiceType', 'category'=>'Chest of drawers','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>12]],
            ['name'=>'numberOfDoors', 'label'=>'MIN Number of doors', 'type'=>'ChoiceType', 'category'=>'Chest of drawers','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>12]],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Chest of drawers','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Other']],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Chest of drawers'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Chest of drawers'],
            // Closet
            ['name'=>'numberOfDrawer', 'label'=>'MIN Number of drawer', 'type'=>'ChoiceType', 'category'=>'Closet','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>12]],
            ['name'=>'numberOfStaging', 'label'=>'MIN Number of staging', 'type'=>'ChoiceType', 'category'=>'Closet','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>12]],
            ['name'=>'numberOfDoors', 'label'=>'MIN Number of doors', 'type'=>'ChoiceType', 'category'=>'Closet','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>12]],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Closet','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Other']],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Closet'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Closet'],
            // Central table
            ['name'=>'shape', 'type'=>'ChoiceType', 'category'=>'Central table','typeOfChoice'=>'TextOptions', 'choice'=>['Oval','Circular','Square','Rectangle','Complex','Other']],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Central table','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Other']],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Central table'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Central table'],
            // Bed
            ['name'=>'numberOfPersson', 'label'=>'MIN Number of persson', 'type'=>'ChoiceType', 'category'=>'Bed','typeOfChoice'=>'TextOptions', 'choice'=>['1'=>1,'1.5'=>1.5,'2'=>2]],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Bed','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Mixed','Other']],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Bed'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Bed'],
            // Mattress'
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Mattress'],
            ['name'=>'numberOfPersson', 'label'=>'MIN Number of persson', 'type'=>'ChoiceType', 'category'=>'Mattress','typeOfChoice'=>'TextOptions', 'choice'=>['1'=>1,'1.5'=>1.5,'2'=>2]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Mattress'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Mattress'],
            //Quilt
            ['name'=>'numberOfPersson', 'label'=>'MIN Number of persson', 'type'=>'ChoiceType', 'category'=>'Quilt','typeOfChoice'=>'TextOptions', 'choice'=>['1'=>1,'1.5'=>1.5,'2'=>2]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Quilt'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Quilt'],
            //Carpet
            ['name'=>'shape', 'type'=>'ChoiceType', 'category'=>'Carpet','typeOfChoice'=>'TextOptions', 'choice'=>['Oval','Circular','Square','Rectangle','Complex','Other']],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Carpet'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Carpet'],
            //Chair
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Chair','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Mixed','Other']],
            ['name'=>'number', 'label'=>'MIN Number (unit)', 'type'=>'ChoiceType', 'category'=>'Chair','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>12]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Chair'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Chair'],
            //Office chair
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Office chair','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Mixed','Other']],
            ['name'=>'number', 'label'=>'MIN Number (unit)', 'type'=>'ChoiceType', 'category'=>'Office chair','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>12]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Office chair'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Office chair'],
            //Sofa
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Sofa','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Mixed','Other']],
            ['name'=>'number', 'label'=>'MIN Number (unit)', 'label'=>'Number MIN', 'type'=>'ChoiceType', 'category'=>'Sofa','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>12]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Sofa'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Sofa'],
            //Racks
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Racks','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Mixed','Other']],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Racks'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Racks'],
            //Study table
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Study table','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Mixed','Other']],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Study table'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Study table'],
            //Click clack
            ['name'=>'numberOfPersson', 'label'=>'MIN Number of persson', 'type'=>'ChoiceType', 'category'=>'Click clack','typeOfChoice'=>'NumericOptions', 'choice'=>[1,2,3,4]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Click clack'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Click clack'],
            //Nightstand
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Nightstand','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Mixed','Other']],
            ['name'=>'numberOfDrawer', 'label'=>'MIN Number of drawer', 'type'=>'ChoiceType', 'category'=>'Nightstand','typeOfChoice'=>'NumericOptions', 'choice'=>[1,2,3,4]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Nightstand'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Nightstand'],
            //Shoe cabinet
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Shoe cabinet','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Mixed','Other']],
            ['name'=>'numberOfDrawer', 'label'=>'MIN Number of drawer', 'type'=>'ChoiceType', 'category'=>'Shoe cabinet','typeOfChoice'=>'NumericOptions', 'choice'=>[1,2,3,4,5,6,7,8]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Shoe cabinet'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Shoe cabinet'],
            //Chandelier
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Chandelier','typeOfChoice'=>'TextOptions', 'choice'=>['Glass','Crystal','Carton','Funt','Metal','Wood','Plastic','Mixed','Other']],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Chandelier'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Chandelier'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Chandelier'],
            //Antic
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Antic'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Antic'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Antic'],
            //Painting
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Painting'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Painting'],
            //Roses
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Roses'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Roses'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Roses'],
            //Curtain
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Curtain'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Curtain'],
            //Floor lamp
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Floor lamp'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Floor lamp'],
            //Mirror
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Mirror'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Mirror'],
            //furniture_Other
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'furniture_Other'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'furniture_Other'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'furniture_Other'],

            //holidays--------------------------------------------------------------------------------------------------
            //  Camp
            ['name'=>'city', 'type'=>'EntityType', 'category'=>'Camp'],

            // Hotel
            ['name'=>'city', 'type'=>'EntityType', 'category'=>'Hotel'],

            // Cottage
            ['name'=>'city', 'type'=>'EntityType', 'category'=>'Cottage'],

            // Chalet
            ['name'=>'city', 'type'=>'EntityType', 'category'=>'Chalet'],
            ['name'=>'numberOfRooms', 'label'=>'MIN Number of rooms','type'=>'ChoiceType', 'category'=>'Chalet','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>12]],

            // Cards and reservations

            ['name'=>'eventType', 'label' => 'All type of events', 'type'=>'ChoiceType', 'category'=>'Cards and reservations','typeOfChoice'=>'TextOptions', 'choice'=>['Music','Cinema','Sport','Theater','Party','Resturant','Tourist','Travel','Other']],
            ['name'=>'city', 'type'=>'EntityType', 'category'=>'Cards and reservations'],
            ['name'=>'numberOfPersson', 'label'=>'MIN Number of persson', 'type'=>'ChoiceType', 'category'=>'Cards and reservations','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>8]],
            ['name'=>'number', 'label'=>'MIN Number (unit)', 'type'=>'ChoiceType', 'category'=>'Cards and reservations','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>10]],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Cards and reservations'],

            // holiday_Other
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'holiday_Other'],
            ['name'=>'city', 'type'=>'EntityType', 'category'=>'holiday_Other'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'holiday_Other'],
        ];

        $specificationSearchOffer = [
            // car
            ['name'=>'brand', 'type'=>'ChoiceType', 'category'=>'Car','typeOfChoice'=>'TextOptions', 'choice'=>['Peugeot','Renault','Citroen','DS','BMW','Mercedes-Benz','Opel','Volkswagen','Seat','Ford','Fiat','Alfa romeo','Dacia','Jaguar','Lotus','Lexus','Mini','Porsche','Volvo','Scoda','Tesla','Jeep','Land rover','Bentley','Infiniti','Toyota','Suzuki','Subaru','Nissan','Mitsubishi','Honda','Kia','Hyundai','Other']],
            ['name'=>'minManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Car','choice'=>['min'=>1945,'max'=>$thisYear]],
            ['name'=>'maxManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Car','choice'=>['min'=>1946,'max'=>$thisYear]],
            ['name'=>'numberOfPassengers','label'=>'MIN Number of passengers', 'type'=>'ChoiceType', 'category'=>'Car','typeOfChoice'=>'SequentialNumericOptions','choice'=>['min'=>1,'max'=>48]],
            ['name'=>'fuelType', 'type'=>'ChoiceType', 'category'=>'Car','typeOfChoice'=>'TextOptions', 'choice'=>['Gasoline','Diesel','LPG','Electric','Hybrid']],
            ['name'=>'numberOfDoors','label'=>'MIN Number of doors', 'type'=>'ChoiceType', 'category'=>'Car','typeOfChoice'=>'SequentialNumericOptions','choice'=>['min'=>1,'max'=>8]],
            ['name'=>'minKilometer', 'type'=>'ChoiceType', 'category'=>'Car','typeOfChoice'=>'NumericOptions', 'choice'=>[0,15000,30000,45000,60000,75000,90000,105000,120000,150000,180000,200000,225000,250000,275000,300000]],
            ['name'=>'maxKilometer', 'type'=>'ChoiceType', 'category'=>'Car','typeOfChoice'=>'NumericOptions', 'choice'=>[15000,30000,45000,60000,75000,90000,105000,120000,150000,180000,200000,225000,250000,275000,300000]],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Car'],
            ['name'=>'changeGear', 'type'=>'ChoiceType', 'category'=>'Car','typeOfChoice'=>'TextOptions', 'choice'=>['Automatic','Manual']],
            ['name'=>'price','label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Car'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Car'],

            // Motor   cm² cm³
            ['name'=>'brand', 'type'=>'ChoiceType', 'category'=>'Motor','typeOfChoice'=>'TextOptions', 'choice'=>['Midual','Peugeot','Vespa','Rds Side Cars','Scorpa','Gas Gas','Clipic Motor','Hyosung','Rieju','Derbi','Bmw','Muz','Harley - Davidson','Buell','Indian Motorcycle','Sherco','Atk','Royal Enfield','Triumph','Ccm Motorcycle','Aprilia','Borile','Benelli','Honda','Yamaha','Suzuki','Kawasaki','Toyota','Suzuki','Cagiva','Vertemati','Laverda','Ktm','Husqvarna','Ural Russian Motorcycle','Jawa','Boxer Design','BMS','Other']],
            ['name'=>'minManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Motor','choice'=>['min'=>1945,'max'=>$thisYear]],
            ['name'=>'maxManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Motor','choice'=>['min'=>1946,'max'=>$thisYear]],
            ['name'=>'minKilometer', 'type'=>'ChoiceType', 'category'=>'Motor','typeOfChoice'=>'NumericOptions', 'choice'=>[0,5000,10000,15000,30000,45000,60000,75000,90000,105000,120000,150000,180000,200000,225000,250000,275000,300000]],
            ['name'=>'maxKilometer', 'type'=>'ChoiceType', 'category'=>'Motor','typeOfChoice'=>'NumericOptions', 'choice'=>[5000,10000,15000,30000,45000,60000,75000,90000,105000,120000,150000,180000,200000,225000,250000,275000,300000]],
            ['name'=>'minCapacity','label'=>'MIN capacity (cm³)', 'type'=>'ChoiceType', 'category'=>'Motor','typeOfChoice'=>'NumericOptions', 'choice'=>[0,50,80,110,140,170,200,230,450,650,800,1000]],
            ['name'=>'maxCapacity','label'=>'MAX capacity (cm³)', 'type'=>'ChoiceType', 'category'=>'Motor','typeOfChoice'=>'NumericOptions', 'choice'=>[50,80,110,140,170,200,230,450,650,800,1000]],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Motor'],
            ['name'=>'price','label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Motor'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Motor'],

            // Caravan
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Caravan'],
            ['name'=>'minManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Caravan','choice'=>['min'=>1945,'max'=>$thisYear]],
            ['name'=>'maxManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Caravan','choice'=>['min'=>1946,'max'=>$thisYear]],
            ['name'=>'fuelType', 'type'=>'ChoiceType', 'category'=>'Caravan','typeOfChoice'=>'TextOptions', 'choice'=>['Gasoline','Diesel','LPG','Electric','Hybrid']],
            ['name'=>'minKilometer', 'type'=>'ChoiceType', 'category'=>'Caravan','typeOfChoice'=>'NumericOptions', 'choice'=>[0,15000,30000,45000,60000,75000,90000,105000,120000,150000,180000,200000,225000,250000,275000,300000]],
            ['name'=>'maxKilometer', 'type'=>'ChoiceType', 'category'=>'Caravan','typeOfChoice'=>'NumericOptions', 'choice'=>[15000,30000,45000,60000,75000,90000,105000,120000,150000,180000,200000,225000,250000,275000,300000]],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Caravan'],
            ['name'=>'price','label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Caravan'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Caravan'],
            // Boat
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Boat'],
            ['name'=>'minManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Boat','choice'=>['min'=>1945,'max'=>$thisYear]],
            ['name'=>'maxManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Boat','choice'=>['min'=>1946,'max'=>$thisYear]],
            ['name'=>'fuelType', 'type'=>'ChoiceType', 'category'=>'Boat','typeOfChoice'=>'TextOptions', 'choice'=>['Gasoline','Diesel','LPG','Electric','Hybrid']],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Boat'],
            ['name'=>'price','label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Boat'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Boat'],
            // Agricultural machinery
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Agricultural machinery'],
            ['name'=>'minManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Agricultural machinery','choice'=>['min'=>1945,'max'=>$thisYear]],
            ['name'=>'maxManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Agricultural machinery','choice'=>['min'=>1946,'max'=>$thisYear]],
            ['name'=>'fuelType', 'type'=>'ChoiceType', 'category'=>'Agricultural machinery','typeOfChoice'=>'TextOptions', 'choice'=>['Gasoline','Diesel','LPG','Electric','Hybrid']],
            ['name'=>'minKilometer', 'type'=>'ChoiceType', 'category'=>'Agricultural machinery','typeOfChoice'=>'NumericOptions', 'choice'=>[0,15000,30000,45000,60000,75000,90000,105000,120000,150000,180000,200000,225000,250000,275000,300000]],
            ['name'=>'maxKilometer', 'type'=>'ChoiceType', 'category'=>'Agricultural machinery','typeOfChoice'=>'NumericOptions', 'choice'=>[15000,30000,45000,60000,75000,90000,105000,120000,150000,180000,200000,225000,250000,275000,300000]],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Agricultural machinery'],
            ['name'=>'price','label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Agricultural machinery'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Agricultural machinery'],
            // Car parts
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Car parts'],
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Car parts'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Car parts','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'price','label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Car parts'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Car parts'],
            // Motor parts
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Motor parts'],
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Motor parts'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Motor parts','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'price','label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Motor parts'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Motor parts'],
            // Vehicle accessories
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Vehicle accessories'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Vehicle accessories'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Vehicle accessories','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'price','label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Vehicle accessories'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Vehicle accessories'],

            // vehicle_other
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'vehicle_other'],
            ['name'=>'price','label'=>'Price MAX', 'type'=>'TextType', 'category'=>'vehicle_other'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'vehicle_other'],

            //Jobs and services-------------------------------------------------------------------------------------
            // Job opportunity
            ['name'=>'activityArea', 'type'=>'ChoiceType', 'category'=>'Job opportunity','typeOfChoice'=>'TextOptions', 'choice'=>['Agriculture','Mining and quarrying ','Manufacturing','Electricity/gas','Construction','Transporting','food service','Information','Financial and insurance','Real estate','scientific and technical','Administrative and support','Public administration','Education','Human health','Arts','General services','Rights and Law','Tourism and Hotels','Fashion']],
            ['name'=>'workHours', 'type'=>'ChoiceType', 'category'=>'Job opportunity','typeOfChoice'=>'TextOptions', 'choice'=>['Full','Partial']],
            ['name'=>'salary','label'=>'Salary MIN (€)', 'type'=>'TextType', 'category'=>'Job opportunity'],
            ['name'=>'typeOfContract', 'type'=>'ChoiceType', 'category'=>'Job opportunity','typeOfChoice'=>'TextOptions', 'choice'=>['CDI','CDD','CTT','CUI','alternation','Independent']],
            ['name'=>'experience', 'type'=>'ChoiceType', 'category'=>'Job opportunity','typeOfChoice'=>'TextOptions', 'choice'=>['Not required' => 0,'1 YEAR'=> 1,'2 YEARS' => 2,'3 YEARS' => 3,'4 YEARS' => 4,'5 YEARS' => 5,'+ 5 YEARS' => 6]],
            ['name'=>'levelOfStudy', 'type'=>'ChoiceType', 'category'=>'Job opportunity','typeOfChoice'=>'TextOptions', 'choice'=>['Not required','High School','Diploma','University','Postgraduate']],

            // Translation
            ['name'=>'languages', 'type'=>'ChoiceType', 'category'=>'Translation','typeOfChoice'=>'TextOptions', 'choice'=>['English','German','Italian','Spanish','Ukrainian','Polish','Dutch','Turkish','Romanian','Arabic','Austro-Bavarian','Russian','Hungarian','Greek','Czech','Portuguese','Swedish','Bulgarian','Albanian','Slovak','Chinese','Japanese','Indian','Vietnamese','Persian','Indonesian']],
            ['name'=>'typeOfTranslation', 'type'=>'ChoiceType', 'category'=>'Translation','typeOfChoice'=>'TextOptions', 'choice'=>['Immediate translation','Translate documents','All']],

            // Mathematics lessons
            ['name'=>'placeOfLesson', 'type'=>'ChoiceType', 'category'=>'Mathematics lessons','typeOfChoice'=>'TextOptions', 'choice'=>['At the student','At the teacher','Not important','Other']],
            ['name'=>'levelOfStudent', 'type'=>'ChoiceType', 'category'=>'Mathematics lessons','typeOfChoice'=>'TextOptions', 'choice'=>['Maternal school'=>1,'Middle school'=>2,'High school'=>3,'Universities'=>4,'Professional'=>5]],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Mathematics lessons'],
            // Music lessons
            ['name'=>'placeOfLesson', 'type'=>'ChoiceType', 'category'=>'Music lessons','typeOfChoice'=>'TextOptions', 'choice'=>['At the student','At the teacher','Not important','Other']],
            ['name'=>'subjectName', 'type'=>'ChoiceType', 'category'=>'Music lessons','typeOfChoice'=>'TextOptions', 'choice'=>['piano','Violin','Trumpet','Flute','Clarinet','Cello','Contrabass','Guitar','digital keyboard','accordion','Rhythm','Solfege','Other']],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Music lessons'],

            // Language lessons
            ['name'=>'subjectName', 'type'=>'ChoiceType', 'category'=>'Language lessons','typeOfChoice'=>'TextOptions', 'choice'=>['English','German','Italian','Spanish','Turkish','Arabic','Russian','Greek','Portuguese','Swedish','Chinese','Japanese','Other']],
            ['name'=>'placeOfLesson', 'type'=>'ChoiceType', 'category'=>'Language lessons','typeOfChoice'=>'TextOptions', 'choice'=>['At the student','At the teacher','Not important']],
            ['name'=>'levelOfStudent', 'type'=>'ChoiceType', 'category'=>'Language lessons','typeOfChoice'=>'TextOptions', 'choice'=>['Maternal school'=>1,'Middle school'=>2,'High school'=>3,'Universities'=>4,'Professional'=>5]],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Language lessons'],
            // Language exchange
            ['name'=>'language', 'type'=>'ChoiceType', 'category'=>'Language exchange','typeOfChoice'=>'TextOptions', 'choice'=>['French','English','German','Italian','Spanish','Ukrainian','Polish','Dutch','Turkish','Romanian','Arabic','Austro-Bavarian','Russian','Hungarian','Greek','Czech','Portuguese','Swedish','Bulgarian','Albanian','Slovak','Chinese','Japanese','Indian','Vietnamese','Persian','Indonesian','Other']],
            ['name'=>'secondLanguage', 'type'=>'ChoiceType', 'category'=>'Language exchange','typeOfChoice'=>'TextOptions', 'choice'=>['French','English','German','Italian','Spanish','Ukrainian','Polish','Dutch','Turkish','Romanian','Arabic','Austro-Bavarian','Russian','Hungarian','Greek','Czech','Portuguese','Swedish','Bulgarian','Albanian','Slovak','Chinese','Japanese','Indian','Vietnamese','Persian','Indonesian','Other']],

            // House work
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'House work'],
            ['name'=>'material', 'type'=>'TextType', 'category'=>'House work'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'House work'],
            // Maintenance services
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Maintenance services'],
            // jobs_other
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'jobs_other'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'jobs_other'],




            //Media-------------------------------------------------------------------------------------------
            //TV
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'TV'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'TV','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'theType', 'type'=>'ChoiceType', 'category'=>'TV','typeOfChoice'=>'TextOptions', 'choice'=>['Normal','Smart']],
            ['name'=>'price','label'=>'Price MAX', 'type'=>'TextType', 'category'=>'TV'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'TV'],
            //Wolkman
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Wolkman'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Wolkman','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'price','label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Wolkman'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Wolkman'],
            // Camera
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Camera'],
            ['name'=>'accuracy','label'=>'MIN Accuracy (mp)', 'type'=>'TextType', 'category'=>'Camera'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Camera','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Camera'],
            ['name'=>'price','label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Camera'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Camera'],
            //Audio accessories
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Audio accessories'],
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Audio accessories'],
            ['name'=>'price','label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Audio accessories'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Audio accessories'],
            //Camera accessories
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Camera accessories'],
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Camera accessories'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Camera accessories'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Camera accessories'],
            //Headphones
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Headphones'],
            ['name'=>'wifi', 'type'=>'CheckboxType', 'category'=>'Headphones'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Headphones','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Headphones'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Headphones'],
            //Telephone
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Telephone'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Telephone','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Telephone'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Telephone'],
            //Video games
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Video games'],
            ['name'=>'accessories', 'type'=>'CheckboxType', 'category'=>'Video games'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Video games'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Video games'],
            //DVD Games
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'DVD Games'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'DVD Games'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'DVD Games'],
            //Games accessories
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Games accessories'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Games accessories','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Games accessories'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Games accessories'],
            //Movies
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Movies'],
            ['name'=>'dvdCd', 'label'=>'DVD CD', 'type'=>'ChoiceType', 'category'=>'Movies','typeOfChoice'=>'TextOptions', 'choice'=>['DVD','CD']],
            ['name'=>'language', 'type'=>'ChoiceType', 'category'=>'Movies','typeOfChoice'=>'TextOptions', 'choice'=>['French','English','German','Italian','Spanish','Ukrainian','Polish','Dutch','Turkish','Romanian','Arabic','Austro-Bavarian','Russian','Hungarian','Greek','Czech','Portuguese','Swedish','Bulgarian','Albanian','Slovak','Chinese','Japanese','Indian','Vietnamese','Persian','Indonesian','Other']],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Movies'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Movies'],

            //Books
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Books'],
            ['name'=>'language', 'type'=>'ChoiceType', 'category'=>'Books','typeOfChoice'=>'TextOptions', 'choice'=>['French','English','German','Italian','Spanish','Ukrainian','Polish','Dutch','Turkish','Romanian','Arabic','Austro-Bavarian','Russian','Hungarian','Greek','Czech','Portuguese','Swedish','Bulgarian','Albanian','Slovak','Chinese','Japanese','Indian','Vietnamese','Persian','Indonesian','Other']],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Books'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Books'],
            //media_Other
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'media_Other'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'media_Other'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'media_Other'],



            //informations--------------------------------------------------------------------------
            // Computer
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Computer'],
            ['name'=>'minCapacity', 'label'=>'MIN HDD capacity (gb)','type'=>'ChoiceType', 'category'=>'Computer','typeOfChoice'=>'NumericOptions', 'choice'=>[0,60,100,120,160,200,250,300,500,720,750,800,1000,2000,3000,4000,8000]],
            ['name'=>'maxCapacity', 'label'=>'MAX HDD capacity (gb)','type'=>'ChoiceType', 'category'=>'Computer','typeOfChoice'=>'NumericOptions', 'choice'=>[60,100,120,160,200,250,300,500,720,750,800,1000,2000,3000,4000,8000]],
            ['name'=>'ram', 'label'=>'MIN Ram capacity (gb)','type'=>'ChoiceType', 'category'=>'Computer','typeOfChoice'=>'NumericOptions', 'choice'=>[1,2,3,4,6,8,12,16,24,32,64]],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Computer','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Computer'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Computer'],
            // laptop
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'laptop'],
            ['name'=>'minCapacity', 'label'=>'MIN HDD capacity (gb)','type'=>'ChoiceType', 'category'=>'laptop','typeOfChoice'=>'NumericOptions', 'choice'=>[0,60,100,120,160,200,250,300,500,720,750,800,1000,2000,3000,4000,8000]],
            ['name'=>'maxCapacity', 'label'=>'MAX HDD capacity (gb)','type'=>'ChoiceType', 'category'=>'laptop','typeOfChoice'=>'NumericOptions', 'choice'=>[60,100,120,160,200,250,300,500,720,750,800,1000,2000,3000,4000,8000]],
            ['name'=>'ram', 'label'=>'MIN Ram capacity (gb)','type'=>'ChoiceType', 'category'=>'laptop','typeOfChoice'=>'NumericOptions', 'choice'=>[1,2,3,4,6,8,12,16,24,32,64]],
            ['name'=>'hdmi', 'type'=>'CheckboxType', 'category'=>'laptop'],
            ['name'=>'cdRoom', 'type'=>'CheckboxType', 'category'=>'laptop'],
            ['name'=>'accessories', 'type'=>'CheckboxType', 'category'=>'laptop'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'laptop','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'laptop'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'laptop'],
            // Tablet
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Tablet'],
            ['name'=>'minCapacity', 'label'=>'MIN SSD capacity (gb)','type'=>'ChoiceType', 'category'=>'Tablet','typeOfChoice'=>'NumericOptions', 'choice'=>[0,4,8,12,16,32,64,128,256,512,1024]],
            ['name'=>'maxCapacity', 'label'=>'MAX SSD capacity (gb)','type'=>'ChoiceType', 'category'=>'Tablet','typeOfChoice'=>'NumericOptions', 'choice'=>[4,8,12,16,32,64,128,256,512,1024]],
            ['name'=>'ram', 'label'=>'MIN Ram capacity (gb)','type'=>'ChoiceType', 'category'=>'Tablet','typeOfChoice'=>'NumericOptions', 'choice'=>[0.5,1,2,3,4,6,8,16]],
            ['name'=>'accessories', 'type'=>'CheckboxType', 'category'=>'Tablet'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Tablet','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Tablet'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Tablet'],
            // Mobile
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Mobile'],
            ['name'=>'minCapacity', 'label'=>'MIN SSD capacity (gb)','type'=>'ChoiceType', 'category'=>'Mobile','typeOfChoice'=>'NumericOptions', 'choice'=>[0,4,8,12,16,32,64,128,256,512,1024]],
            ['name'=>'maxCapacity', 'label'=>'MAX SSD capacity (gb)','type'=>'ChoiceType', 'category'=>'Mobile','typeOfChoice'=>'NumericOptions', 'choice'=>[4,8,12,16,32,64,128,256,512,1024]],
            ['name'=>'ram', 'label'=>'MIN Ram capacity (gb)','type'=>'ChoiceType', 'category'=>'Mobile','typeOfChoice'=>'NumericOptions', 'choice'=>[0.5,1,2,3,4,6,8,16]],
            ['name'=>'accessories', 'type'=>'CheckboxType', 'category'=>'Mobile'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Mobile','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Mobile'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Mobile'],
            // Scanner
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Scanner'],
            ['name'=>'wifi', 'type'=>'CheckboxType', 'category'=>'Scanner'],
            ['name'=>'usb', 'type'=>'CheckboxType', 'category'=>'Scanner'],
            ['name'=>'paperSize', 'type'=>'ChoiceType', 'category'=>'Scanner','typeOfChoice'=>'TextOptions', 'choice'=>['4A0' => 1,'2A0' => 2,'A0' => 3,'A1'=>4,'A2'=>5,'A3'=>6,'A4'=>7,'A5'=>8,'A6'=>9,'A7'=>10,'A8'=>11,'A9'=>12,'A10'=>13]],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Scanner','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Scanner'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Scanner'],
            // Printer
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Printer'],
            ['name'=>'printingType', 'type'=>'ChoiceType', 'category'=>'Printer','typeOfChoice'=>'TextOptions', 'choice'=>['Inkjet','Laser','Other']],
            ['name'=>'printingColor', 'type'=>'ChoiceType', 'category'=>'Printer','typeOfChoice'=>'TextOptions', 'choice'=>['Black and white','Colored','Other']],
            ['name'=>'wifi', 'type'=>'CheckboxType', 'category'=>'Printer'],
            ['name'=>'usb', 'type'=>'CheckboxType', 'category'=>'Printer'],
            ['name'=>'threeInOne', 'type'=>'CheckboxType', 'category'=>'Printer'],
            ['name'=>'paperSize', 'type'=>'ChoiceType', 'category'=>'Printer','typeOfChoice'=>'TextOptions', 'choice'=>['4A0' => 1,'2A0' => 2,'A0' => 3,'A1'=>4,'A2'=>5,'A3'=>6,'A4'=>7,'A5'=>8,'A6'=>9,'A7'=>10,'A8'=>11,'A9'=>12,'A10'=>13]],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Printer','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Printer'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Printer'],
            // Monitor
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Monitor'],
            ['name'=>'hdmi', 'type'=>'CheckboxType', 'category'=>'Monitor'],
            ['name'=>'usb', 'type'=>'CheckboxType', 'category'=>'Monitor'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Monitor','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Monitor'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Monitor'],
            // information_mouse
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'information_mouse'],
            ['name'=>'wifi', 'type'=>'CheckboxType', 'category'=>'information_mouse'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'information_mouse','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'information_mouse'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'information_mouse'],
            // keyboard
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'keyboard'],
            ['name'=>'languages', 'type'=>'ChoiceType', 'category'=>'keyboard','typeOfChoice'=>'TextOptions', 'choice'=>['English','German','Italian','Spanish','Ukrainian','Polish','Dutch','Turkish','Romanian','Arabic','Austro-Bavarian','Russian','Hungarian','Greek','Czech','Portuguese','Swedish','Bulgarian','Albanian','Slovak','Chinese','Japanese','Indian','Vietnamese','Persian','Indonesian']],
            ['name'=>'wifi', 'type'=>'CheckboxType', 'category'=>'keyboard'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'keyboard','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'keyboard'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'keyboard'],
            // Speaker
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Speaker'],
            ['name'=>'wifi', 'type'=>'CheckboxType', 'category'=>'Speaker'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Speaker','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Speaker'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Speaker'],
            // Hard disk
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Hard disk'],
            ['name'=>'minCapacity', 'label'=>'MIN HDD capacity (gb)','type'=>'ChoiceType', 'category'=>'Hard disk','typeOfChoice'=>'NumericOptions', 'choice'=>[0,60,100,120,160,200,250,300,500,720,750,800,1000,2000,3000,4000,8000]],
            ['name'=>'maxCapacity', 'label'=>'MAX HDD Capacity (gb)','type'=>'ChoiceType', 'category'=>'Hard disk','typeOfChoice'=>'NumericOptions', 'choice'=>[60,100,120,160,200,250,300,500,720,750,800,1000,2000,3000,4000,8000]],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Hard disk','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Hard disk'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Hard disk'],

            // information_Other
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'information_Other'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'information_Other'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'information_Other'],



            //fashions-------------------------------------------------------------------------------------------------
            // T-shirt
            ['name'=>'sSize', 'label'=>'Size','type'=>'ChoiceType', 'category'=>'T-shirt','typeOfChoice'=>'TextOptions', 'choice'=>['XS','S','M','L','XL','XXL','XXXL']],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'T-shirt','typeOfChoice'=>'TextOptions', 'choice'=>['Wool','Cotton','Linen','Leather','Polyster','Cloth','jeans','Other']],
            ['name'=>'theType', 'type'=>'ChoiceType', 'category'=>'T-shirt','typeOfChoice'=>'TextOptions', 'choice'=>['Men','Women']],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'T-shirt'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'T-shirt'],
            // Shirt
            ['name'=>'sSize', 'label'=>'Size','type'=>'ChoiceType', 'category'=>'Shirt','typeOfChoice'=>'TextOptions', 'choice'=>['XS','S','M','L','XL','XXL','XXXL']],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Shirt','typeOfChoice'=>'TextOptions', 'choice'=>['Wool','Cotton','Linen','Leather','Polyster','Cloth','jeans','Other']],
            ['name'=>'theType', 'type'=>'ChoiceType', 'category'=>'Shirt','typeOfChoice'=>'TextOptions', 'choice'=>['Men','Women']],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Shirt'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Shirt'],
            // Trouser
            ['name'=>'iSize', 'label'=>'Size','type'=>'ChoiceType', 'category'=>'Trouser','typeOfChoice'=>'NumericOptions', 'choice'=>[32,34,36,38,40,41,42,43,44,45,46,47,48,50,52,54,56,58,60,62]],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Trouser','typeOfChoice'=>'TextOptions', 'choice'=>['Wool','Cotton','Linen','Leather','Polyster','Cloth','Other']],
            ['name'=>'theType', 'type'=>'ChoiceType', 'category'=>'Trouser','typeOfChoice'=>'TextOptions', 'choice'=>['Men','Women']],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Trouser'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Trouser'],
            // Short
            ['name'=>'iSize', 'label'=>'Size','type'=>'ChoiceType', 'category'=>'Short','typeOfChoice'=>'NumericOptions', 'choice'=>[32,34,36,38,40,41,42,43,44,45,46,47,48,50,52,54,56,58,60,62]],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Short','typeOfChoice'=>'TextOptions', 'choice'=>['Wool','Cotton','Linen','Leather','Polyster','Cloth','Other']],
            ['name'=>'theType', 'type'=>'ChoiceType', 'category'=>'Short','typeOfChoice'=>'TextOptions', 'choice'=>['Men','Women']],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Short'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Short'],
            // Costume
            ['name'=>'sSize', 'label'=>'Size','type'=>'ChoiceType', 'category'=>'Costume','typeOfChoice'=>'TextOptions', 'choice'=>['XS','S','M','L','XL','XXL','XXXL']],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Costume','typeOfChoice'=>'TextOptions', 'choice'=>['Wool','Cotton','Linen','Leather','Polyster','Cloth','Other']],
            ['name'=>'theType', 'type'=>'ChoiceType', 'category'=>'Costume','typeOfChoice'=>'TextOptions', 'choice'=>['Men','Women']],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Costume'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Costume'],
            // Dress
            ['name'=>'sSize', 'label'=>'Size','type'=>'ChoiceType', 'category'=>'Dress','typeOfChoice'=>'TextOptions', 'choice'=>['XS','S','M','L','XL','XXL','XXXL']],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Dress','typeOfChoice'=>'TextOptions', 'choice'=>['Felt','Hessian','chiffon','Velours','Denim','Mousseline','Popeline','Charmeuse','Taffeta','Habutai','Other']],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Dress'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Dress'],
            // Wedding dress
            ['name'=>'sSize', 'label'=>'Size','type'=>'ChoiceType', 'category'=>'Wedding dress','typeOfChoice'=>'TextOptions', 'choice'=>['XS','S','M','L','XL','XXL','XXXL']],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Wedding dress','typeOfChoice'=>'TextOptions', 'choice'=>['Satin','Charmeuse','Chiffon','Organza','Tulle','Lace','mikado','radzmir','gazar','Other']],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Wedding dress'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Wedding dress'],
            // Jacket
            ['name'=>'sSize', 'label'=>'Size','type'=>'ChoiceType', 'category'=>'Jacket','typeOfChoice'=>'TextOptions', 'choice'=>['XS','S','M','L','XL','XXL','XXXL']],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Jacket','typeOfChoice'=>'TextOptions', 'choice'=>['Wool','Cotton','Linen','Leather','Polyster','Polyurethane','Fleece','Nylon','Cashmere','Shearling','Other']],
            ['name'=>'theType', 'type'=>'ChoiceType', 'category'=>'Jacket','typeOfChoice'=>'TextOptions', 'choice'=>['Men','Women']],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Jacket'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Jacket'],
            // Langerie
            ['name'=>'sSize', 'label'=>'Size','type'=>'ChoiceType', 'category'=>'Langerie','typeOfChoice'=>'TextOptions', 'choice'=>['XS','S','M','L','XL','XXL','XXXL']],
            ['name'=>'material', 'type'=>'TextType', 'category'=>'Langerie'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Langerie'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Langerie'],
            // Shoe
            ['name'=>'iSize', 'label'=>'Size','type'=>'ChoiceType', 'category'=>'Shoe','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>36,'max'=>48]],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Shoe','typeOfChoice'=>'TextOptions', 'choice'=>['Leather','Textiles','Synthetics','Rubber','Polyster','Foam','Other']],
            ['name'=>'theType', 'type'=>'ChoiceType', 'category'=>'Shoe','typeOfChoice'=>'TextOptions', 'choice'=>['Men','Women']],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Shoe'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Shoe'],
            // Slide sandal
            ['name'=>'iSize', 'label'=>'Size','type'=>'ChoiceType', 'category'=>'Slide sandal','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>36,'max'=>48]],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Slide sandal','typeOfChoice'=>'TextOptions', 'choice'=>['Leather','Textiles','Synthetics','Rubber','Polyster','Foam','Other']],
            ['name'=>'theType', 'type'=>'ChoiceType', 'category'=>'Slide sandal','typeOfChoice'=>'TextOptions', 'choice'=>['Men','Women']],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Slide sandal'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Slide sandal'],
            // Athletic shoe
            ['name'=>'iSize', 'label'=>'Size','type'=>'ChoiceType', 'category'=>'Athletic shoe','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>36,'max'=>48]],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Athletic shoe','typeOfChoice'=>'TextOptions', 'choice'=>['Leather','Textiles','Synthetics','Rubber','Polyster','Foam','Other']],
            ['name'=>'theType', 'type'=>'ChoiceType', 'category'=>'Athletic shoe','typeOfChoice'=>'TextOptions', 'choice'=>['Men','Women']],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Athletic shoe'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Athletic shoe'],
            // fashion_Other
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'fashion_Other'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'fashion_Other'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'fashion_Other'],



            //homeAppliances-------------------------------------------------------------------------------------------
            //Refrigerator
            ['name'=>'minCapacity', 'label'=>'MIN Capacity (liter)','type'=>'ChoiceType', 'category'=>'Refrigerator','typeOfChoice'=>'TextOptions', 'choice'=>['Less than 50 Liters'=> 1,'50-80 Liters'=> 2,'80-150 Liters'=> 3,'150-250 Liters'=> 4,'250-330 Liters'=>5,'330-490 Liters'=> 6,'More than 50 Liters'=>7]],
            ['name'=>'withFreezer', 'type'=>'CheckboxType', 'category'=>'Refrigerator'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Refrigerator'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Refrigerator'],

            //Cookers gas
            ['name'=>'fuelType','type'=>'ChoiceType', 'category'=>'Cookers gas','typeOfChoice'=>'TextOptions', 'choice'=>['City gas','Bottle gas']],
            ['name'=>'numberOfHead','label'=>'MIN Number Of Head','type'=>'ChoiceType', 'category'=>'Cookers gas','typeOfChoice'=>'NumericOptions', 'choice'=>[1,2,3,4,5,6,7,8]],
            ['name'=>'withOven', 'type'=>'CheckboxType', 'category'=>'Cookers gas'],
            ['name'=>'electricHead', 'type'=>'CheckboxType', 'category'=>'Cookers gas'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Cookers gas'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Cookers gas'],
            //Cookers electric
            ['name'=>'numberOfHead','label'=>'MIN Number Of Head','type'=>'ChoiceType', 'category'=>'Cookers electric','typeOfChoice'=>'NumericOptions', 'choice'=>[1,2,3,4,5,6,7,8]],
            ['name'=>'withOven', 'type'=>'CheckboxType', 'category'=>'Cookers electric'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Cookers electric'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Cookers electric'],
            //Gas plate
            ['name'=>'numberOfHead','label'=>'MIN Number Of Head','type'=>'ChoiceType', 'category'=>'Gas plate','typeOfChoice'=>'NumericOptions', 'choice'=>[1,2,3,4,5,6,7,8]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Gas plate'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Gas plate'],
            //Washing machine
            ['name'=>'minCapacity', 'label'=>'MIN Capacity (kg)','type'=>'ChoiceType', 'category'=>'Washing machine','typeOfChoice'=>'NumericOptions', 'choice'=>[3,4,5,6,7,8,9,10,12]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Washing machine'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Washing machine'],
            //Fan
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Fan'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Fan'],
            //Coffee machine
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Coffee machine'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Coffee machine'],
            //Electric kettle
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Electric kettle'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Electric kettle'],
            //Vaccuum cleaner
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Vaccuum cleaner'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Vaccuum cleaner'],
            //Oven
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Oven'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Oven'],
            //Blender
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Blender'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Blender'],
            //Stand Mixer
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Stand Mixer'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Stand Mixer'],
            //Dishwashers
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Dishwashers'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Dishwashers'],
            //Electric fryer
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Electric fryer'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Electric fryer'],
            //Freezer
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Freezer'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Freezer'],
            //Pressure cooker
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Pressure cooker'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Pressure cooker'],
            //Heater
            ['name'=>'fuelType', 'type'=>'ChoiceType', 'category'=>'Heater','typeOfChoice'=>'TextOptions', 'choice'=>['Gas','Diesel','fuelwood','Electric','Other']],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Heater'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Heater'],
            //Iron
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Iron'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Iron'],
            //Men's shaver
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Men\'s shaver'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Men\'s shaver'],
            //Lady shavers
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Lady shavers'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Lady shavers'],
            //Sandwich toaster
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Sandwich toaster'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Sandwich toaster'],
            //Meat grinder
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Meat grinder'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Meat grinder'],
            //Grilling charcoal
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Grilling charcoal'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Grilling charcoal'],
            //Hair dryer
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Hair dryer'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Hair dryer'],
            //Juicer machine
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Juicer machine'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Juicer machine'],
            //Electric vegetable
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Electric vegetable'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Electric vegetable'],
            //Kitchen accessories
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Kitchen accessories'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Kitchen accessories'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Kitchen accessories'],
            //home_Other
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'home_Other'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'home_Other'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'home_Other'],



            //gardens--------------------------------------------------------------------------------------------------
            // Garden table
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Garden table','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Other']],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Garden table'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Garden table'],
            // Swing
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Swing','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Other']],
            ['name'=>'numberOfPersson', 'label'=>'MIN Number of persson','type'=>'ChoiceType', 'category'=>'Swing','typeOfChoice'=>'NumericOptions', 'choice'=>[1,2,3,4,5,6,7,8]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Swing'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Swing'],
            // Seedlings
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Seedlings'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Seedlings'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Seedlings'],
            // Garden chair
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Garden chair','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Other']],
            ['name'=>'number', 'label'=>'MIN Number (unit)','type'=>'ChoiceType', 'category'=>'Garden chair','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>50]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Garden chair'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Garden chair'],
            // Lawn mower
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Lawn mower'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Lawn mower'],
            // Chainsaw
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Chainsaw'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Chainsaw'],
            // Garden tools
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Garden tools'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Garden tools'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Garden tools'],
            // Fuelwood
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Fuelwood'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Fuelwood'],
            // Electric generator
            ['name'=>'fuelType', 'type'=>'ChoiceType', 'category'=>'Electric generator','typeOfChoice'=>'TextOptions', 'choice'=>['Diesel','Gasoline','Gas','Other']],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Electric generator'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Electric generator'],
            // garden_Other
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'garden_Other'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'garden_Other'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'garden_Other'],





            //residences------------------------------------------------------------------------------------------------
            // Sell house cm²
            ['name'=>'withFurniture', 'type'=>'CheckboxType', 'category'=>'Sell house'],
            ['name'=>'withGarden', 'type'=>'CheckboxType', 'category'=>'Sell house'],
            ['name'=>'minArea','label'=>'MIN Area (m²)', 'type'=>'ChoiceType', 'category'=>'Sell house','typeOfChoice'=>'NumericOptions', 'choice'=>[0,50,60,70,80,90,100,110,120,150,200,250,300]],
            ['name'=>'maxArea','label'=>'MAX Area (m²)', 'type'=>'ChoiceType', 'category'=>'Sell house','typeOfChoice'=>'NumericOptions', 'choice'=>[50,60,70,80,90,100,110,120,150,200,250,300,400]],
            ['name'=>'numberOfRooms', 'label'=>'MIN Number of rooms','type'=>'ChoiceType', 'category'=>'Sell house','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>12]],
            ['name'=>'heatingType', 'type'=>'ChoiceType', 'category'=>'Sell house','typeOfChoice'=>'TextOptions', 'choice'=>['Diesel','Electricity','Fuelwood','Gas','Other']],
            ['name'=>'classEnergie', 'label'=>'Class energie MAX', 'type'=>'ChoiceType', 'category'=>'Sell house','typeOfChoice'=>'TextOptions', 'choice'=>['A'=> 1,'B'=> 2,'C' => 3,'D' => 4,'E'=>5,'F'=>6,'G'=>7]],
            ['name'=>'ges', 'label'=>'GES MAX', 'type'=>'ChoiceType', 'category'=>'Sell house','typeOfChoice'=>'TextOptions', 'choice'=>['A'=> 1,'B'=> 2,'C' => 3,'D' => 4,'E'=>5,'F'=>6,'G'=>7]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Sell house'],

            // Sell apartment
            ['name'=>'withFurniture', 'type'=>'CheckboxType', 'category'=>'Sell apartment'],
            ['name'=>'withVerandah', 'type'=>'CheckboxType', 'category'=>'Sell apartment'],
            ['name'=>'withElevator', 'type'=>'CheckboxType', 'category'=>'Sell apartment'],
            ['name'=>'minArea','label'=>'MIN Area (m²)', 'type'=>'ChoiceType', 'category'=>'Sell apartment','typeOfChoice'=>'NumericOptions', 'choice'=>[0,7,15,20,25,30,35,40,50,60,70,80,90,100,110,120,150,200,250]],
            ['name'=>'maxArea','label'=>'MAX Area (m²)', 'type'=>'ChoiceType', 'category'=>'Sell apartment','typeOfChoice'=>'NumericOptions', 'choice'=>[7,15,20,25,30,35,40,50,60,70,80,90,100,110,120,150,200,250,300]],
            ['name'=>'numberOfRooms', 'label'=>'MIN Number of rooms','type'=>'ChoiceType', 'category'=>'Sell apartment','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>12]],
            ['name'=>'heatingType', 'type'=>'ChoiceType', 'category'=>'Sell apartment','typeOfChoice'=>'TextOptions', 'choice'=>['Diesel','Electricity','Fuelwood','Gas','Other']],
            ['name'=>'heating', 'type'=>'ChoiceType', 'category'=>'Sell apartment','typeOfChoice'=>'TextOptions', 'choice'=>['Individually','Collective','Other']],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Sell apartment'],

            // Sell office
            ['name'=>'withFurniture', 'type'=>'CheckboxType', 'category'=>'Sell office'],
            ['name'=>'withElevator', 'type'=>'CheckboxType', 'category'=>'Sell office'],
            ['name'=>'minArea','label'=>'MIN Area (m²)', 'type'=>'ChoiceType', 'category'=>'Sell office','typeOfChoice'=>'NumericOptions', 'choice'=>[0,15,20,25,30,35,40,50,60,70,80,90,100,110,120,150,200,250]],
            ['name'=>'maxArea','label'=>'MAX Area (m²)', 'type'=>'ChoiceType', 'category'=>'Sell office','typeOfChoice'=>'NumericOptions', 'choice'=>[15,20,25,30,35,40,50,60,70,80,90,100,110,120,150,200,250,300]],
            ['name'=>'numberOfRooms', 'label'=>'MIN Number of rooms','type'=>'ChoiceType', 'category'=>'Sell office','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>12]],
            ['name'=>'heatingType', 'type'=>'ChoiceType', 'category'=>'Sell office','typeOfChoice'=>'TextOptions', 'choice'=>['Diesel','Electricity','Fuelwood','Gas','Other']],
            ['name'=>'heating', 'type'=>'ChoiceType', 'category'=>'Sell office','typeOfChoice'=>'TextOptions', 'choice'=>['Individually','Collective','Other']],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Sell office'],

            // Sell shop
            ['name'=>'minArea','label'=>'MIN Area (m²)', 'type'=>'ChoiceType', 'category'=>'Sell shop','typeOfChoice'=>'NumericOptions', 'choice'=>[0,7,15,20,25,30,35,40,50,60,70,80,90,100,110,120,150,200,250]],
            ['name'=>'maxArea','label'=>'MAX Area (m²)', 'type'=>'ChoiceType', 'category'=>'Sell shop','typeOfChoice'=>'NumericOptions', 'choice'=>[7,15,20,25,30,35,40,50,60,70,80,90,100,110,120,150,200,250,300]],
            ['name'=>'heatingType', 'type'=>'ChoiceType', 'category'=>'Sell shop','typeOfChoice'=>'TextOptions', 'choice'=>['Diesel','Electricity','Gas','Other']],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Sell shop'],

            // Sell car parking
            ['name'=>'covered', 'type'=>'CheckboxType', 'category'=>'Sell car parking'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Sell car parking'],

            // Sell farm
            ['name'=>'minArea','label'=>'MIN Area (m²)', 'type'=>'ChoiceType', 'category'=>'Sell farm','typeOfChoice'=>'NumericOptions', 'choice'=>[0,100,150,200,250,300,350,400,450,500,700,900,1000,1200,1500,2000,3000,4000,5000]],
            ['name'=>'maxArea','label'=>'MAX Area (m²)', 'type'=>'ChoiceType', 'category'=>'Sell farm','typeOfChoice'=>'NumericOptions', 'choice'=>[100,150,200,250,300,350,400,450,500,700,900,1000,1200,1500,2000,3000,4000,5000,10000]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Sell farm'],

            // Rent house
            ['name'=>'withFurniture', 'type'=>'CheckboxType', 'category'=>'Rent house'],
            ['name'=>'withGarden', 'type'=>'CheckboxType', 'category'=>'Rent house'],
            ['name'=>'minArea','label'=>'MIN Area (m²)', 'type'=>'ChoiceType', 'category'=>'Rent house','typeOfChoice'=>'NumericOptions', 'choice'=>[0,50,60,70,80,90,100,110,120,150,200,250,300]],
            ['name'=>'maxArea','label'=>'MAX Area (m²)', 'type'=>'ChoiceType', 'category'=>'Rent house','typeOfChoice'=>'NumericOptions', 'choice'=>[50,60,70,80,90,100,110,120,150,200,250,300,400]],
            ['name'=>'numberOfRooms', 'label'=>'MIN Number of rooms','type'=>'ChoiceType', 'category'=>'Rent house','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>12]],
            ['name'=>'heatingType', 'type'=>'ChoiceType', 'category'=>'Rent house','typeOfChoice'=>'TextOptions', 'choice'=>['Diesel','Electricity','Fuelwood','Gas','Other']],
            ['name'=>'classEnergie', 'label'=>'Class energie MAX', 'type'=>'ChoiceType', 'category'=>'Rent house','typeOfChoice'=>'TextOptions', 'choice'=>['A'=> 1,'B'=> 2,'C' => 3,'D' => 4,'E'=>5,'F'=>6,'G'=>7]],
            ['name'=>'ges', 'label'=>'GES MAX', 'type'=>'ChoiceType', 'category'=>'Rent house','typeOfChoice'=>'TextOptions', 'choice'=>['A'=> 1,'B'=> 2,'C' => 3,'D' => 4,'E'=>5,'F'=>6,'G'=>7]],
            ['name'=>'price','label'=>'Rent MAX', 'type'=>'TextType', 'category'=>'Rent house'],
            // Rent apartment
            ['name'=>'withFurniture', 'type'=>'CheckboxType', 'category'=>'Rent apartment'],
            ['name'=>'withVerandah', 'type'=>'CheckboxType', 'category'=>'Rent apartment'],
            ['name'=>'withElevator', 'type'=>'CheckboxType', 'category'=>'Rent apartment'],
            ['name'=>'minArea','label'=>'MIN Area (m²)', 'type'=>'ChoiceType', 'category'=>'Rent apartment','typeOfChoice'=>'NumericOptions', 'choice'=>[0,7,15,20,25,30,35,40,50,60,70,80,90,100,110,120,150,200,250]],
            ['name'=>'maxArea','label'=>'MAX Area (m²)', 'type'=>'ChoiceType', 'category'=>'Rent apartment','typeOfChoice'=>'NumericOptions', 'choice'=>[7,15,20,25,30,35,40,50,60,70,80,90,100,110,120,150,200,250,300]],
            ['name'=>'numberOfRooms', 'label'=>'MIN Number of rooms','type'=>'ChoiceType', 'category'=>'Rent apartment','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>12]],
            ['name'=>'heatingType', 'type'=>'ChoiceType', 'category'=>'Rent apartment','typeOfChoice'=>'TextOptions', 'choice'=>['Diesel','Electricity','Fuelwood','Gas','Other']],
            ['name'=>'heating', 'type'=>'ChoiceType', 'category'=>'Rent apartment','typeOfChoice'=>'TextOptions', 'choice'=>['Individually','Collective','Other']],
            ['name'=>'price', 'label'=>'Rent MAX', 'type'=>'TextType', 'category'=>'Rent apartment'],

            // Office rental
            ['name'=>'withElevator', 'type'=>'CheckboxType', 'category'=>'Office rental'],
            ['name'=>'minArea','label'=>'MIN Area (m²)', 'type'=>'ChoiceType', 'category'=>'Office rental','typeOfChoice'=>'NumericOptions', 'choice'=>[0,15,20,25,30,35,40,50,60,70,80,90,100,110,120,150,200,250]],
            ['name'=>'maxArea','label'=>'MAX Area (m²)', 'type'=>'ChoiceType', 'category'=>'Office rental','typeOfChoice'=>'NumericOptions', 'choice'=>[15,20,25,30,35,40,50,60,70,80,90,100,110,120,150,200,250,300]],
            ['name'=>'numberOfRooms', 'label'=>'MIN Number of rooms','type'=>'ChoiceType', 'category'=>'Office rental','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>12]],
            ['name'=>'heatingType', 'type'=>'ChoiceType', 'category'=>'Office rental','typeOfChoice'=>'TextOptions', 'choice'=>['Diesel','Electricity','Fuelwood','Gas','Other']],
            ['name'=>'heating', 'type'=>'ChoiceType', 'category'=>'Office rental','typeOfChoice'=>'TextOptions', 'choice'=>['Individually','Collective','Other']],
            ['name'=>'price','label'=>'Rent MAX', 'type'=>'TextType', 'category'=>'Office rental'],

            // Rent shop
            ['name'=>'minArea','label'=>'MIN Area (m²)', 'type'=>'ChoiceType', 'category'=>'Rent shop','typeOfChoice'=>'NumericOptions', 'choice'=>[0,7,15,20,25,30,35,40,50,60,70,80,90,100,110,120,150,200,250]],
            ['name'=>'maxArea','label'=>'MAX Area (m²)', 'type'=>'ChoiceType', 'category'=>'Rent shop','typeOfChoice'=>'NumericOptions', 'choice'=>[7,15,20,25,30,35,40,50,60,70,80,90,100,110,120,150,200,250,300]],
            ['name'=>'heatingType', 'type'=>'ChoiceType', 'category'=>'Rent shop','typeOfChoice'=>'TextOptions', 'choice'=>['Diesel','Electricity','Gas','Other']],
            ['name'=>'price', 'label'=>'Rent MAX', 'type'=>'TextType', 'category'=>'Rent shop'],

            // Rent car parking
            ['name'=>'covered', 'type'=>'CheckboxType', 'category'=>'Rent car parking'],
            ['name'=>'price','label'=>'Rent MAX', 'type'=>'TextType', 'category'=>'Rent car parking'],

            // Rent farm
            ['name'=>'minArea','label'=>'MIN Area (m²)', 'type'=>'ChoiceType', 'category'=>'Rent farm','typeOfChoice'=>'NumericOptions', 'choice'=>[0,100,150,200,250,300,350,400,450,500,700,900,1000,1200,1500,2000,3000,4000,5000]],
            ['name'=>'maxArea','label'=>'MAX Area (m²)', 'type'=>'ChoiceType', 'category'=>'Rent farm','typeOfChoice'=>'NumericOptions', 'choice'=>[100,150,200,250,300,350,400,450,500,700,900,1000,1200,1500,2000,3000,4000,5000,10000]],
            ['name'=>'price','label'=>'Rent MAX', 'type'=>'TextType', 'category'=>'Rent farm'],

            // Collective housing
            ['name'=>'theType', 'type'=>'ChoiceType', 'category'=>'Collective housing','typeOfChoice'=>'TextOptions', 'choice'=>['House','Apartment','Residential center','Other']],
            ['name'=>'withFurniture', 'type'=>'CheckboxType', 'category'=>'Collective housing'],
            ['name'=>'withElevator', 'type'=>'CheckboxType', 'category'=>'Collective housing'],
            ['name'=>'heatingType', 'type'=>'ChoiceType', 'category'=>'Collective housing','typeOfChoice'=>'TextOptions', 'choice'=>['Diesel','Electricity','Fuelwood','Gas','Other']],
            ['name'=>'price','label'=>'Rent MAX', 'type'=>'TextType', 'category'=>'Collective housing'],

            // residence_Other
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'residence_Other'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'residence_Other'],





            //jewelrys---------------------------------------------------------------------------------------------------
            // Necklaces
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Necklaces','typeOfChoice'=>'TextOptions', 'choice'=>['Silver','Silver filled','Yellow gold','White gold','Rose gold','Green gold','Base Metal','Platinum','Titanium','gemstone','mixed','Other']],
            ['name'=>'weight', 'label'=>'MAX Weight (g)', 'type'=>'TextType', 'category'=>'Necklaces'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Necklaces'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Necklaces'],
            // Collier
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Collier','typeOfChoice'=>'TextOptions', 'choice'=>['Silver','Silver filled','Yellow gold','White gold','Rose gold','Green gold','Base Metal','Platinum','Titanium','gemstone','mixed','Other']],
            ['name'=>'weight', 'label'=>'MAX Weight (g)', 'type'=>'TextType', 'category'=>'Collier'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Collier'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Collier'],
            // Bracelet
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Bracelet','typeOfChoice'=>'TextOptions', 'choice'=>['Silver','Silver filled','Yellow gold','White gold','Rose gold','Green gold','Base Metal','Platinum','Titanium','gemstone','mixed','Other']],
            ['name'=>'weight', 'label'=>'MAX Weight (g)', 'type'=>'TextType', 'category'=>'Bracelet'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Bracelet'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Bracelet'],
            // Ring
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Ring','typeOfChoice'=>'TextOptions', 'choice'=>['Silver','Silver filled','Yellow gold','White gold','Rose gold','Green gold','Base Metal','Platinum','Titanium','gemstone','mixed','Other']],
            ['name'=>'weight', 'label'=>'MAX Weight (g)', 'type'=>'TextType', 'category'=>'Ring'],
            ['name'=>'iSize', 'label'=>'Size Of Ring','type'=>'ChoiceType', 'category'=>'Ring','typeOfChoice'=>'NumericOptions', 'choice'=>[45,47,50,53,57,60,63,66,69]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Ring'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Ring'],
            // Watch
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Watch'],
            ['name'=>'analogDigital', 'type'=>'ChoiceType', 'category'=>'Watch','typeOfChoice'=>'TextOptions', 'choice'=>['Analogue','Digital','Other']],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Watch'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Watch'],
            // Earrings
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Earrings','typeOfChoice'=>'TextOptions', 'choice'=>['Silver','Silver filled','Yellow gold','White gold','Rose gold','Green gold','Base Metal','Platinum','Titanium','gemstone','mixed','Other']],
            ['name'=>'weight', 'label'=>'MAX Weight (g)', 'type'=>'TextType', 'category'=>'Earrings'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Earrings'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Earrings'],
            // Perfumes
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Perfumes'],
            ['name'=>'maxCapacity', 'label'=>'MAX Capacity (ml)', 'type'=>'TextType', 'category'=>'Perfumes'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Perfumes'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Perfumes'],
            // Wine
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Wine'],
            ['name'=>'capacity', 'label'=>'MAX Capacity (ml)', 'type'=>'ChoiceType', 'category'=>'Wine','typeOfChoice'=>'NumericOptions', 'choice'=>[100,187,375,750,1000,1500,3000]],
            ['name'=>'minManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Wine','choice'=>['min'=>1890,'max'=>$thisYear]],
            ['name'=>'maxManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Wine','choice'=>['min'=>1891,'max'=>$thisYear]],
            ['name'=>'originCountry', 'type'=>'ChoiceType', 'category'=>'Wine','typeOfChoice'=>'TextOptions', 'choice'=>['France','Italy','Spain','Chile','Australia','United States','Germany','New zealand','Portugal','Argentina','Croatia','Switzerland','Other']],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Wine'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Wine'],
            // jewelry_Other
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'jewelry_Other'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'jewelry_Other'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'jewelry_Other'],





            //musics---------------------------------------------------------------------------------------------------
            // Piano
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Piano'],
            ['name'=>'minManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Piano','choice'=>['min'=>1920,'max'=>$thisYear]],
            ['name'=>'maxManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Piano','choice'=>['min'=>1921,'max'=>$thisYear]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Piano'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Piano'],
            // Violin
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Violin'],
            ['name'=>'minManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Violin','choice'=>['min'=>1920,'max'=>$thisYear]],
            ['name'=>'maxManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Violin','choice'=>['min'=>1921,'max'=>$thisYear]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Violin'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Violin'],
            // Trumpet
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Trumpet'],
            ['name'=>'minManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Trumpet','choice'=>['min'=>1920,'max'=>$thisYear]],
            ['name'=>'maxManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Trumpet','choice'=>['min'=>1921,'max'=>$thisYear]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Trumpet'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Trumpet'],
            // Flute
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Flute'],
            ['name'=>'minManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Flute','choice'=>['min'=>1920,'max'=>$thisYear]],
            ['name'=>'maxManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Flute','choice'=>['min'=>1921,'max'=>$thisYear]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Flute'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Flute'],
            // Clarinet
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Clarinet'],
            ['name'=>'minManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Clarinet','choice'=>['min'=>1920,'max'=>$thisYear]],
            ['name'=>'maxManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Clarinet','choice'=>['min'=>1921,'max'=>$thisYear]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Clarinet'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Clarinet'],
            // Drums
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Drums'],
            ['name'=>'minManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Drums','choice'=>['min'=>1920,'max'=>$thisYear]],
            ['name'=>'maxManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Drums','choice'=>['min'=>1921,'max'=>$thisYear]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Drums'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Drums'],
            // Cello
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Cello'],
            ['name'=>'minManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Cello','choice'=>['min'=>1920,'max'=>$thisYear]],
            ['name'=>'maxManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Cello','choice'=>['min'=>1921,'max'=>$thisYear]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Cello'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Cello'],
            // Contrabass
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Contrabass'],
            ['name'=>'minManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Contrabass','choice'=>['min'=>1920,'max'=>$thisYear]],
            ['name'=>'maxManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Contrabass','choice'=>['min'=>1921,'max'=>$thisYear]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Contrabass'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Contrabass'],
            // Electric guitar
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Electric guitar'],
            ['name'=>'minManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Electric guitar','choice'=>['min'=>1920,'max'=>$thisYear]],
            ['name'=>'maxManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Electric guitar','choice'=>['min'=>1921,'max'=>$thisYear]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Electric guitar'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Electric guitar'],
            // Classic guitar
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Classic guitar'],
            ['name'=>'minManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Classic guitar','choice'=>['min'=>1920,'max'=>$thisYear]],
            ['name'=>'maxManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Classic guitar','choice'=>['min'=>1921,'max'=>$thisYear]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Classic guitar'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Classic guitar'],
            // Digital keyboard
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Digital keyboard'],
            ['name'=>'minManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Digital keyboard','choice'=>['min'=>1940,'max'=>$thisYear]],
            ['name'=>'maxManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Digital keyboard','choice'=>['min'=>1941,'max'=>$thisYear]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Digital keyboard'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Digital keyboard'],
            // Accordion
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Accordion'],
            ['name'=>'minManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Accordion','choice'=>['min'=>1920,'max'=>$thisYear]],
            ['name'=>'maxManufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Accordion','choice'=>['min'=>1921,'max'=>$thisYear]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Accordion'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Accordion'],
            // Music accessories
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Music accessories'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Music accessories'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Music accessories'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Music accessories'],
            // music_Other
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'music_Other'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'music_Other'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'music_Other'],



            //sports--------------------------------------------------------------------------------------------------
            // Ski boots
            ['name'=>'iSize', 'label'=>'Size', 'type'=>'ChoiceType', 'category'=>'Ski boots','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>32,'max'=>48]],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Ski boots','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Ski boots'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Ski boots'],
            // Roller skating
            ['name'=>'iSize', 'label'=>'Size', 'type'=>'ChoiceType', 'category'=>'Roller skating','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>32,'max'=>48]],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Roller skating','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Roller skating'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Roller skating'],
            // Parachute
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Parachute'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Parachute'],
            // Swimming glasses
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Swimming glasses'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Swimming glasses'],
            // Football
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Football'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Football'],
            // Basketball
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Basketball'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Basketball'],
            // Iron balls
            ['name'=>'number', 'label'=>'MIN Number (unit)','type'=>'ChoiceType', 'category'=>'Iron balls','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>30]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Iron balls'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Iron balls'],
            // Volley ball
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Volley ball'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Volley ball'],
            // American football
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'American football'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'American football'],
            // Sports tool
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Sports tool'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Sports tool','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Sports tool'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Sports tool'],
            // Bicycle
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Bicycle'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Bicycle','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Bicycle'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Bicycle'],
            // Bicycle accessories
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Bicycle accessories'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Bicycle accessories','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Bicycle accessories'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Bicycle accessories'],
            // sport_Other
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'sport_Other'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'sport_Other'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'sport_Other'],



            //Pets-----------------------------------------------------------------------------------------------------
            //  Cat
            ['name'=>'age', 'label'=>'MAX Age (year)', 'type'=>'TextType', 'category'=>'Cat'],
            ['name'=>'animalSpecies', 'type'=>'TextType', 'category'=>'Cat'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Cat'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Cat'],
            // Dog
            ['name'=>'age', 'label'=>'MAX Age (year)', 'type'=>'TextType', 'category'=>'Dog'],
            ['name'=>'animalSpecies', 'type'=>'TextType', 'category'=>'Dog'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Dog'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Dog'],
            // Hamster
            ['name'=>'age', 'label'=>'MAX Age (year)', 'type'=>'TextType', 'category'=>'Hamster'],
            ['name'=>'animalSpecies', 'type'=>'TextType', 'category'=>'Hamster'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Hamster'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Hamster'],
            // Mouse
            ['name'=>'age', 'label'=>'MAX Age (year)', 'type'=>'TextType', 'category'=>'Mouse'],
            ['name'=>'animalSpecies', 'type'=>'TextType', 'category'=>'Mouse'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Mouse'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Mouse'],
            // pet_Other
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'pet_Other'],
            ['name'=>'age', 'label'=>'MAX Age (year)', 'type'=>'TextType', 'category'=>'pet_Other'],
            ['name'=>'animalSpecies', 'type'=>'TextType', 'category'=>'pet_Other'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'pet_Other'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'pet_Other'],



            //kids------------------------------------------------------------------------------------------------------
            //  Crib
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Crib','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Other']],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Crib'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Crib'],
            // kids_Chest of drawers

            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'kids_Chest of drawers','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Other']],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'kids_Chest of drawers'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'kids_Chest of drawers'],
            // Stroller
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Stroller'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Stroller'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Stroller'],
            // Diapers
            ['name'=>'iSize', 'label'=>'Size', 'type'=>'ChoiceType', 'category'=>'Diapers','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>0,'max'=>8]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Diapers'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Diapers'],
            // kids_Mattress
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'kids_Mattress'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'kids_Mattress'],
            // Baby clothes
            ['name'=>'iSize', 'label'=>'Size', 'type'=>'ChoiceType', 'category'=>'Baby clothes','typeOfChoice'=>'NumericOptions', 'choice'=>[40,44,50,54,60,67,71,74,81,86,94,102,108,116,122,128,134,140,146,152,158,164,170,174,180]],
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Baby clothes'],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Baby clothes','typeOfChoice'=>'TextOptions', 'choice'=>['Cotton','Cloth','Polyester','Linen','Jeans','Wool','Silk','Other']],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Baby clothes'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Baby clothes'],
            // Baby tools
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Baby tools'],
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Baby tools'],
            ['name'=>'age', 'label'=>'Min age','type'=>'ChoiceType', 'category'=>'Baby tools','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>15]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Baby tools'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Baby tools'],
            // Baby toys
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Baby toys'],
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Baby toys'],
            ['name'=>'age', 'label'=>'Min age','type'=>'ChoiceType', 'category'=>'Baby toys','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>15]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Baby toys'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Baby toys'],
            // kid_Other
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'kid_Other'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'kid_Other'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'kid_Other'],



            // furnitures-----------------------------------------------------------------------------------------------
            //  Couch
            ['name'=>'numberOfPersson', 'label'=>'MIN Number of persson', 'type'=>'ChoiceType', 'category'=>'Couch','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>5]],
            ['name'=>'coverMaterial', 'type'=>'ChoiceType', 'category'=>'Couch','typeOfChoice'=>'TextOptions', 'choice'=>['Cotton','Cloth','Leather','Linen','Velvet','Chamois','Other']],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Couch'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Couch'],
            // Dining table
            ['name'=>'numberOfPersson', 'label'=>'MIN Number of persson', 'type'=>'ChoiceType', 'category'=>'Dining table','typeOfChoice'=>'NumericOptions', 'choice'=>[2,4,6,8,10,12,14]],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Dining table','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Other']],
            ['name'=>'shape', 'type'=>'ChoiceType', 'category'=>'Dining table','typeOfChoice'=>'TextOptions', 'choice'=>['Oval','Circular','Square','Rectangle','Complex','Other']],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Dining table'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Dining table'],
            // Chest of drawers
            ['name'=>'numberOfDrawer', 'label'=>'MIN Number of drawer', 'type'=>'ChoiceType', 'category'=>'Chest of drawers','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>12]],
            ['name'=>'numberOfStaging', 'label'=>'MIN Number of staging', 'type'=>'ChoiceType', 'category'=>'Chest of drawers','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>12]],
            ['name'=>'numberOfDoors', 'label'=>'MIN Number of doors', 'type'=>'ChoiceType', 'category'=>'Chest of drawers','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>12]],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Chest of drawers','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Other']],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Chest of drawers'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Chest of drawers'],
            // Closet
            ['name'=>'numberOfDrawer', 'label'=>'MIN Number of drawer', 'type'=>'ChoiceType', 'category'=>'Closet','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>12]],
            ['name'=>'numberOfStaging', 'label'=>'MIN Number of staging', 'type'=>'ChoiceType', 'category'=>'Closet','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>12]],
            ['name'=>'numberOfDoors', 'label'=>'MIN Number of doors', 'type'=>'ChoiceType', 'category'=>'Closet','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>12]],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Closet','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Other']],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Closet'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Closet'],
            // Central table
            ['name'=>'shape', 'type'=>'ChoiceType', 'category'=>'Central table','typeOfChoice'=>'TextOptions', 'choice'=>['Oval','Circular','Square','Rectangle','Complex','Other']],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Central table','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Other']],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Central table'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Central table'],
            // Bed
            ['name'=>'numberOfPersson', 'label'=>'MIN Number of persson', 'type'=>'ChoiceType', 'category'=>'Bed','typeOfChoice'=>'TextOptions', 'choice'=>['1'=>1,'1.5'=>1.5,'2'=>2]],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Bed','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Mixed','Other']],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Bed'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Bed'],
            // Mattress'
            ['name'=>'numberOfPersson', 'label'=>'MIN Number of persson', 'type'=>'ChoiceType', 'category'=>'Mattress','typeOfChoice'=>'TextOptions', 'choice'=>['1'=>1,'1.5'=>1.5,'2'=>2]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Mattress'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Mattress'],
            //Quilt
            ['name'=>'numberOfPersson', 'label'=>'MIN Number of persson', 'type'=>'ChoiceType', 'category'=>'Quilt','typeOfChoice'=>'TextOptions', 'choice'=>['1'=>1,'1.5'=>1.5,'2'=>2]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Quilt'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Quilt'],
            //Carpet
            ['name'=>'shape', 'type'=>'ChoiceType', 'category'=>'Carpet','typeOfChoice'=>'TextOptions', 'choice'=>['Oval','Circular','Square','Rectangle','Complex','Other']],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Carpet'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Carpet'],
            //Chair
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Chair','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Mixed','Other']],
            ['name'=>'number', 'label'=>'MIN Number (unit)', 'type'=>'ChoiceType', 'category'=>'Chair','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>12]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Chair'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Chair'],
            //Office chair
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Office chair','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Mixed','Other']],
            ['name'=>'number', 'label'=>'MIN Number (unit)', 'type'=>'ChoiceType', 'category'=>'Office chair','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>12]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Office chair'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Office chair'],
            //Sofa
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Sofa','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Mixed','Other']],
            ['name'=>'number', 'label'=>'MIN Number (unit)', 'type'=>'ChoiceType', 'category'=>'Sofa','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>12]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Sofa'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Sofa'],
            //Racks
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Racks','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Mixed','Other']],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Racks'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Racks'],
            //Study table
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Study table','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Mixed','Other']],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Study table'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Study table'],
            //Click clack
            ['name'=>'numberOfPersson', 'label'=>'MIN Number of persson', 'type'=>'ChoiceType', 'category'=>'Click clack','typeOfChoice'=>'NumericOptions', 'choice'=>[1,2,3,4]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Click clack'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Click clack'],
            //Nightstand
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Nightstand','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Mixed','Other']],
            ['name'=>'numberOfDrawer', 'label'=>'MIN Number of drawer', 'type'=>'ChoiceType', 'category'=>'Nightstand','typeOfChoice'=>'NumericOptions', 'choice'=>[1,2,3,4]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Nightstand'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Nightstand'],
            //Shoe cabinet
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Shoe cabinet','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Mixed','Other']],
            ['name'=>'numberOfDrawer', 'label'=>'MIN Number of drawer', 'type'=>'ChoiceType', 'category'=>'Shoe cabinet','typeOfChoice'=>'NumericOptions', 'choice'=>[1,2,3,4,5,6,7,8]],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Shoe cabinet'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Shoe cabinet'],
            //Chandelier
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Chandelier','typeOfChoice'=>'TextOptions', 'choice'=>['Glass','Crystal','Carton','Funt','Metal','Wood','Plastic','Mixed','Other']],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Chandelier'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Chandelier'],
            //Antic
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Antic'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Antic'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Antic'],
            //Painting
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Painting'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Painting'],
            //Roses
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Roses'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Roses'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Roses'],
            //Curtain
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Curtain'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Curtain'],
            //Floor lamp
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Floor lamp'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Floor lamp'],
            //Mirror
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'Mirror'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Mirror'],
            //furniture_Other
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'furniture_Other'],
            ['name'=>'price', 'label'=>'Price MAX', 'type'=>'TextType', 'category'=>'furniture_Other'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'furniture_Other'],

            //holidays--------------------------------------------------------------------------------------------------
            //  Camp

            // Hotel

            // Cottage

            // Chalet
            ['name'=>'numberOfRooms', 'label'=>'MIN Number of rooms','type'=>'ChoiceType', 'category'=>'Chalet','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>12]],

            // Cards and reservations

            ['name'=>'numberOfPersson', 'label'=>'MIN Number of persson', 'type'=>'ChoiceType', 'category'=>'Cards and reservations','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>8]],
            ['name'=>'number', 'label'=>'MIN Number (unit)', 'type'=>'ChoiceType', 'category'=>'Cards and reservations','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>10]],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'Cards and reservations'],

            // holiday_Other
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'holiday_Other'],
            ['name'=>'donate', 'type'=>'CheckboxType', 'category'=>'holiday_Other'],
        ];
        $specificationSearchDemand = [
            //Vehicles--------------------------------------------------------------------------------------------------
            // car Engine Capacity
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Car'],
            ['name'=>'manufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Car','choice'=>['min'=>1940,'max'=>$thisYear]],
            ['name'=>'numberOfPassengers', 'type'=>'ChoiceType', 'category'=>'Car','typeOfChoice'=>'SequentialNumericOptions','choice'=>['min'=>1,'max'=>48]],
            ['name'=>'fuelType', 'type'=>'ChoiceType', 'category'=>'Car','typeOfChoice'=>'TextOptions', 'choice'=>['Gasoline','Diesel','LPG','Electric','Hybrid']],
            ['name'=>'numberOfDoors', 'type'=>'ChoiceType', 'category'=>'Car','typeOfChoice'=>'SequentialNumericOptions','choice'=>['min'=>1,'max'=>8]],
            ['name'=>'kilometer', 'type'=>'TextType', 'category'=>'Car'],
            ['name'=>'changeGear', 'type'=>'ChoiceType', 'category'=>'Car','typeOfChoice'=>'TextOptions', 'choice'=>['Automatic','Manual']],


            // Motor
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Motor'],
            ['name'=>'manufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Motor','choice'=>['min'=>1940,'max'=>$thisYear]],
            ['name'=>'capacity','label'=>'Capacity (cm³)', 'type'=>'TextType', 'category'=>'Motor'],
            ['name'=>'kilometer', 'type'=>'TextType', 'category'=>'Motor'],

            // Caravan
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Caravan'],
            ['name'=>'manufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Caravan','choice'=>['min'=>1940,'max'=>$thisYear]],
            ['name'=>'fuelType', 'type'=>'ChoiceType', 'category'=>'Caravan','typeOfChoice'=>'TextOptions', 'choice'=>['Gasoline','Diesel','LPG','Electric','Hybrid']],
            ['name'=>'kilometer', 'type'=>'TextType', 'category'=>'Caravan'],

            // Boat
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Boat'],
            ['name'=>'manufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Boat','choice'=>['min'=>1940,'max'=>$thisYear]],
            ['name'=>'fuelType', 'type'=>'ChoiceType', 'category'=>'Boat','typeOfChoice'=>'TextOptions', 'choice'=>['Gasoline','Diesel','LPG','Electric','Hybrid']],

            // Agricultural machinery
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Agricultural machinery'],
            ['name'=>'manufacturingYear','type'=> 'ChoiceType', 'typeOfChoice'=>'SequentialNumericOptions', 'category'=>'Agricultural machinery','choice'=>['min'=>1940,'max'=>$thisYear]],
            ['name'=>'fuelType', 'type'=>'ChoiceType', 'category'=>'Agricultural machinery','typeOfChoice'=>'TextOptions', 'choice'=>['Gasoline','Diesel','LPG','Electric','Hybrid']],
            ['name'=>'kilometer', 'type'=>'TextType', 'category'=>'Agricultural machinery'],
            // Car parts
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Car parts'],
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Car parts'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Car parts','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            // Motor parts
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Motor parts'],
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Motor parts'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Motor parts','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            // Vehicle accessories
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Vehicle accessories'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Vehicle accessories','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],

            // vehicle_other
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'vehicle_other'],


            //Jobs and services-------------------------------------------------------------------------------------
            // Job opportunity
            ['name'=>'activityArea', 'type'=>'ChoiceType', 'category'=>'Job opportunity','typeOfChoice'=>'TextOptions', 'choice'=>['Agriculture','Mining and quarrying ','Manufacturing','Electricity/gas','Construction','Transporting','food service','Information','Financial and insurance','Real estate','scientific and technical','Administrative and support','Public administration','Education','Human health','Arts','General services','Rights and Law','Tourism and Hotels','Fashion']],
            ['name'=>'workHours', 'type'=>'ChoiceType', 'category'=>'Job opportunity','typeOfChoice'=>'TextOptions', 'choice'=>['Full','Partial']],
            ['name'=>'typeOfContract', 'type'=>'ChoiceType', 'category'=>'Job opportunity','typeOfChoice'=>'TextOptions', 'choice'=>['CDI','CDD','CTT','CUI','alternation','Independent']],
            ['name'=>'experience', 'type'=>'ChoiceType', 'category'=>'Job opportunity','typeOfChoice'=>'TextOptions', 'choice'=>['Not required' => 0,'1 YEAR'=> 1,'2 YEARS' => 2,'3 YEARS' => 3,'4 YEARS' => 4,'5 YEARS' => 5,'+ 5 YEARS' => 6]],
            ['name'=>'levelOfStudy', 'type'=>'ChoiceType', 'category'=>'Job opportunity','typeOfChoice'=>'TextOptions', 'choice'=>['Not required','High School','Diploma','University','Postgraduate']],

            // Translation
            ['name'=>'languages', 'type'=>'ChoiceType', 'category'=>'Translation','typeOfChoice'=>'TextOptions', 'choice'=>['English','German','Italian','Spanish','Ukrainian','Polish','Dutch','Turkish','Romanian','Arabic','Austro-Bavarian','Russian','Hungarian','Greek','Czech','Portuguese','Swedish','Bulgarian','Albanian','Slovak','Chinese','Japanese','Indian','Vietnamese','Persian','Indonesian']],
            ['name'=>'typeOfTranslation', 'type'=>'ChoiceType', 'category'=>'Translation','typeOfChoice'=>'TextOptions', 'choice'=>['Immediate translation','Translate documents','All']],

            // Mathematics lessons
            ['name'=>'placeOfLesson', 'type'=>'ChoiceType', 'category'=>'Mathematics lessons','typeOfChoice'=>'TextOptions', 'choice'=>['At the student','At the teacher','Not important','Other']],
            ['name'=>'levelOfStudent', 'type'=>'ChoiceType', 'category'=>'Mathematics lessons','typeOfChoice'=>'TextOptions', 'choice'=>['Maternal school'=>1,'Middle school'=>2,'High school'=>3,'Universities'=>4,'Professional'=>5]],

            // Music lessons
            ['name'=>'placeOfLesson', 'type'=>'ChoiceType', 'category'=>'Music lessons','typeOfChoice'=>'TextOptions', 'choice'=>['At the student','At the teacher','Not important','Other']],
            ['name'=>'subjectName', 'type'=>'ChoiceType', 'category'=>'Music lessons','typeOfChoice'=>'TextOptions', 'choice'=>['piano','Violin','Trumpet','Flute','Clarinet','Cello','Contrabass','Guitar','digital keyboard','accordion','Rhythm','Solfege','Other']],

            // Language lessons
            ['name'=>'subjectName', 'type'=>'ChoiceType', 'category'=>'Language lessons','typeOfChoice'=>'TextOptions', 'choice'=>['English','German','Italian','Spanish','Turkish','Arabic','Russian','Greek','Portuguese','Swedish','Chinese','Japanese','Other']],
            ['name'=>'placeOfLesson', 'type'=>'ChoiceType', 'category'=>'Language lessons','typeOfChoice'=>'TextOptions', 'choice'=>['At the student','At the teacher','Not important']],
            ['name'=>'levelOfStudent', 'type'=>'ChoiceType', 'category'=>'Language lessons','typeOfChoice'=>'TextOptions', 'choice'=>['Maternal school'=>1,'Middle school'=>2,'High school'=>3,'Universities'=>4,'Professional'=>5]],
            // Language exchange
            ['name'=>'language', 'type'=>'ChoiceType', 'category'=>'Language exchange','typeOfChoice'=>'TextOptions', 'choice'=>['French','English','German','Italian','Spanish','Ukrainian','Polish','Dutch','Turkish','Romanian','Arabic','Austro-Bavarian','Russian','Hungarian','Greek','Czech','Portuguese','Swedish','Bulgarian','Albanian','Slovak','Chinese','Japanese','Indian','Vietnamese','Persian','Indonesian','Other']],
            ['name'=>'secondLanguage', 'type'=>'ChoiceType', 'category'=>'Language exchange','typeOfChoice'=>'TextOptions', 'choice'=>['French','English','German','Italian','Spanish','Ukrainian','Polish','Dutch','Turkish','Romanian','Arabic','Austro-Bavarian','Russian','Hungarian','Greek','Czech','Portuguese','Swedish','Bulgarian','Albanian','Slovak','Chinese','Japanese','Indian','Vietnamese','Persian','Indonesian','Other']],

            // House work
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'House work'],
            ['name'=>'material', 'type'=>'TextType', 'category'=>'House work'],
            // Maintenance services
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Maintenance services'],
            ['name'=>'placeOfLesson', 'type'=>'ChoiceType','label'=>'Place Of Servic', 'category'=>'Maintenance services','typeOfChoice'=>'TextOptions', 'choice'=>['At your house','At us','Not important']],
            // jobs_other
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'jobs_other'],




            //Media-------------------------------------------------------------------------------------------
            //TV
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'TV'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'TV','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            ['name'=>'theType', 'type'=>'ChoiceType', 'category'=>'TV','typeOfChoice'=>'TextOptions', 'choice'=>['Normal','Smart']],
            //Wolkman
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Wolkman'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Wolkman','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            // Camera
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Camera'],
            ['name'=>'accuracy','label'=>'Accuracy (mp)', 'type'=>'TextType', 'category'=>'Camera'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Camera','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            //Audio accessories
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Audio accessories'],
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Audio accessories'],
            //Camera accessories
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Camera accessories'],
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Camera accessories'],
            //Headphones
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Headphones'],
            ['name'=>'wifi', 'type'=>'CheckboxType', 'category'=>'Headphones'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Headphones','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            //Telephone
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Telephone'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Telephone','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],
            //Video games
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Video games'],
            ['name'=>'accessories', 'type'=>'CheckboxType', 'category'=>'Video games'],

            //DVD Games
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'DVD Games'],

            //Games accessories
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Games accessories'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Games accessories','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],

            //Movies
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Movies'],
            ['name'=>'dvdCd', 'label'=>'DVD CD', 'type'=>'ChoiceType', 'category'=>'Movies','typeOfChoice'=>'TextOptions', 'choice'=>['DVD','CD']],
            ['name'=>'language', 'type'=>'ChoiceType', 'category'=>'Movies','typeOfChoice'=>'TextOptions', 'choice'=>['French','English','German','Italian','Spanish','Ukrainian','Polish','Dutch','Turkish','Romanian','Arabic','Austro-Bavarian','Russian','Hungarian','Greek','Czech','Portuguese','Swedish','Bulgarian','Albanian','Slovak','Chinese','Japanese','Indian','Vietnamese','Persian','Indonesian','Other']],


            //Books
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Books'],
            ['name'=>'language', 'type'=>'ChoiceType', 'category'=>'Books','typeOfChoice'=>'TextOptions', 'choice'=>['French','English','German','Italian','Spanish','Ukrainian','Polish','Dutch','Turkish','Romanian','Arabic','Austro-Bavarian','Russian','Hungarian','Greek','Czech','Portuguese','Swedish','Bulgarian','Albanian','Slovak','Chinese','Japanese','Indian','Vietnamese','Persian','Indonesian','Other']],

            //media_Other
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'media_Other'],



            //informations--------------------------------------------------------------------------
            // Computer
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Computer'],
            ['name'=>'capacity', 'label'=>'HDD Capacity (gb)','type'=>'ChoiceType', 'category'=>'Computer','typeOfChoice'=>'NumericOptions', 'choice'=>[60,100,120,160,200,250,300,500,720,750,800,1000,2000,3000,4000,8000]],
            ['name'=>'ram', 'label'=>'RAM Capacity (gb)','type'=>'ChoiceType', 'category'=>'Computer','typeOfChoice'=>'NumericOptions', 'choice'=>[1,2,3,4,6,8,12,16,24,32,64]],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Computer','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],

            // laptop
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'laptop'],
            ['name'=>'capacity', 'label'=>'HDD Capacity (gb)','type'=>'ChoiceType', 'category'=>'laptop','typeOfChoice'=>'NumericOptions', 'choice'=>[60,100,120,160,200,250,300,500,720,750,800,1000,2000,3000,4000,8000]],
            ['name'=>'ram', 'label'=>'RAM Capacity (gb)','type'=>'ChoiceType', 'category'=>'laptop','typeOfChoice'=>'NumericOptions', 'choice'=>[1,2,3,4,6,8,12,16,24,32,64]],
            ['name'=>'hdmi', 'type'=>'CheckboxType', 'category'=>'laptop'],
            ['name'=>'cdRoom', 'type'=>'CheckboxType', 'category'=>'laptop'],
            ['name'=>'accessories', 'type'=>'CheckboxType', 'category'=>'laptop'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'laptop','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],

            // Tablet
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Tablet'],
            ['name'=>'capacity', 'label'=>'SSD Capacity (gb)','type'=>'ChoiceType', 'category'=>'Tablet','typeOfChoice'=>'NumericOptions', 'choice'=>[4,8,12,16,32,64,128,256,512,1024]],
            ['name'=>'ram', 'label'=>'RAM Capacity (gb)','type'=>'ChoiceType', 'category'=>'Tablet','typeOfChoice'=>'NumericOptions', 'choice'=>[0.5,1,2,3,4,6,8,16]],
            ['name'=>'accessories', 'type'=>'CheckboxType', 'category'=>'Tablet'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Tablet','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],

            // Mobile
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Mobile'],
            ['name'=>'capacity', 'label'=>'SSD Capacity (gb)','type'=>'ChoiceType', 'category'=>'Mobile','typeOfChoice'=>'NumericOptions', 'choice'=>[4,8,12,16,32,64,128,256,512,1024]],
            ['name'=>'ram', 'label'=>'RAM Capacity (gb)','type'=>'ChoiceType', 'category'=>'Mobile','typeOfChoice'=>'NumericOptions', 'choice'=>[0.5,1,2,3,4,6,8,16]],
            ['name'=>'accessories', 'type'=>'CheckboxType', 'category'=>'Mobile'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Mobile','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],

            // Scanner
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Scanner'],
            ['name'=>'wifi', 'type'=>'CheckboxType', 'category'=>'Scanner'],
            ['name'=>'usb', 'type'=>'CheckboxType', 'category'=>'Scanner'],
            ['name'=>'paperSize', 'type'=>'ChoiceType', 'category'=>'Scanner','typeOfChoice'=>'TextOptions', 'choice'=>['4A0' => 1,'2A0' => 2,'A0' => 3,'A1'=>4,'A2'=>5,'A3'=>6,'A4'=>7,'A5'=>8,'A6'=>9,'A7'=>10,'A8'=>11,'A9'=>12,'A10'=>13]],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Scanner','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],

            // Printer
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Printer'],
            ['name'=>'printingType', 'type'=>'ChoiceType', 'category'=>'Printer','typeOfChoice'=>'TextOptions', 'choice'=>['Inkjet','Laser','Other']],
            ['name'=>'printingColor', 'type'=>'ChoiceType', 'category'=>'Printer','typeOfChoice'=>'TextOptions', 'choice'=>['Black and white','Colored','Other']],
            ['name'=>'wifi', 'type'=>'CheckboxType', 'category'=>'Printer'],
            ['name'=>'usb', 'type'=>'CheckboxType', 'category'=>'Printer'],
            ['name'=>'threeInOne', 'type'=>'CheckboxType', 'category'=>'Printer'],
            ['name'=>'paperSize', 'type'=>'ChoiceType', 'category'=>'Printer','typeOfChoice'=>'TextOptions', 'choice'=>['4A0' => 1,'2A0' => 2,'A0' => 3,'A1'=>4,'A2'=>5,'A3'=>6,'A4'=>7,'A5'=>8,'A6'=>9,'A7'=>10,'A8'=>11,'A9'=>12,'A10'=>13]],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Printer','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],

            // Monitor
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Monitor'],
            ['name'=>'hdmi', 'type'=>'CheckboxType', 'category'=>'Monitor'],
            ['name'=>'usb', 'type'=>'CheckboxType', 'category'=>'Monitor'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Monitor','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],

            // information_mouse
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'information_mouse'],
            ['name'=>'wifi', 'type'=>'CheckboxType', 'category'=>'information_mouse'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'information_mouse','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],

            // keyboard
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'keyboard'],
            ['name'=>'languages', 'type'=>'ChoiceType', 'category'=>'keyboard','typeOfChoice'=>'TextOptions', 'choice'=>['English','German','Italian','Spanish','Ukrainian','Polish','Dutch','Turkish','Romanian','Arabic','Austro-Bavarian','Russian','Hungarian','Greek','Czech','Portuguese','Swedish','Bulgarian','Albanian','Slovak','Chinese','Japanese','Indian','Vietnamese','Persian','Indonesian']],
            ['name'=>'wifi', 'type'=>'CheckboxType', 'category'=>'keyboard'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'keyboard','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],

            // Speaker
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Speaker'],
            ['name'=>'wifi', 'type'=>'CheckboxType', 'category'=>'Speaker'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Speaker','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],

            // Hard disk
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Hard disk'],
            ['name'=>'capacity', 'label'=>'HDD Capacity (gb)','type'=>'ChoiceType', 'category'=>'Hard disk','typeOfChoice'=>'NumericOptions', 'choice'=>[60,100,120,160,200,250,300,500,720,750,800,1000,2000,3000,4000,8000]],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Hard disk','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],


            // information_Other
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'information_Other'],




            //fashions-------------------------------------------------------------------------------------------------
            // T-shirt
            ['name'=>'sSize', 'label'=>'Size','type'=>'ChoiceType', 'category'=>'T-shirt','typeOfChoice'=>'TextOptions', 'choice'=>['XS','S','M','L','XL','XXL','XXXL']],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'T-shirt','typeOfChoice'=>'TextOptions', 'choice'=>['Wool','Cotton','Linen','Leather','Polyster','Cloth','jeans','Other']],
            ['name'=>'theType', 'type'=>'ChoiceType', 'category'=>'T-shirt','typeOfChoice'=>'TextOptions', 'choice'=>['Men','Women']],

            // Shirt
            ['name'=>'sSize', 'label'=>'Size','type'=>'ChoiceType', 'category'=>'Shirt','typeOfChoice'=>'TextOptions', 'choice'=>['XS','S','M','L','XL','XXL','XXXL']],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Shirt','typeOfChoice'=>'TextOptions', 'choice'=>['Wool','Cotton','Linen','Leather','Polyster','Cloth','jeans','Other']],
            ['name'=>'theType', 'type'=>'ChoiceType', 'category'=>'Shirt','typeOfChoice'=>'TextOptions', 'choice'=>['Men','Women']],

            // Trouser
            ['name'=>'iSize', 'label'=>'Size','type'=>'ChoiceType', 'category'=>'Trouser','typeOfChoice'=>'NumericOptions', 'choice'=>[32,34,36,38,40,41,42,43,44,45,46,47,48,50,52,54,56,58,60,62]],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Trouser','typeOfChoice'=>'TextOptions', 'choice'=>['Wool','Cotton','Linen','Leather','Polyster','Cloth','Other']],
            ['name'=>'theType', 'type'=>'ChoiceType', 'category'=>'Trouser','typeOfChoice'=>'TextOptions', 'choice'=>['Men','Women']],

            // Short
            ['name'=>'iSize', 'label'=>'Size','type'=>'ChoiceType', 'category'=>'Short','typeOfChoice'=>'NumericOptions', 'choice'=>[32,34,36,38,40,41,42,43,44,45,46,47,48,50,52,54,56,58,60,62]],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Short','typeOfChoice'=>'TextOptions', 'choice'=>['Wool','Cotton','Linen','Leather','Polyster','Cloth','Other']],
            ['name'=>'theType', 'type'=>'ChoiceType', 'category'=>'Short','typeOfChoice'=>'TextOptions', 'choice'=>['Men','Women']],

            // Costume
            ['name'=>'sSize', 'label'=>'Size','type'=>'ChoiceType', 'category'=>'Costume','typeOfChoice'=>'TextOptions', 'choice'=>['XS','S','M','L','XL','XXL','XXXL']],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Costume','typeOfChoice'=>'TextOptions', 'choice'=>['Wool','Cotton','Linen','Leather','Polyster','Cloth','Other']],
            ['name'=>'theType', 'type'=>'ChoiceType', 'category'=>'Costume','typeOfChoice'=>'TextOptions', 'choice'=>['Men','Women']],

            // Dress
            ['name'=>'sSize', 'label'=>'Size','type'=>'ChoiceType', 'category'=>'Dress','typeOfChoice'=>'TextOptions', 'choice'=>['XS','S','M','L','XL','XXL','XXXL']],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Dress','typeOfChoice'=>'TextOptions', 'choice'=>['Felt','Hessian','chiffon','Velours','Denim','Mousseline','Popeline','Charmeuse','Taffeta','Habutai','Other']],

            // Wedding dress
            ['name'=>'sSize', 'label'=>'Size','type'=>'ChoiceType', 'category'=>'Wedding dress','typeOfChoice'=>'TextOptions', 'choice'=>['XS','S','M','L','XL','XXL','XXXL']],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Wedding dress','typeOfChoice'=>'TextOptions', 'choice'=>['Satin','Charmeuse','Chiffon','Organza','Tulle','Lace','mikado','radzmir','gazar','Other']],

            // Jacket
            ['name'=>'sSize', 'label'=>'Size','type'=>'ChoiceType', 'category'=>'Jacket','typeOfChoice'=>'TextOptions', 'choice'=>['XS','S','M','L','XL','XXL','XXXL']],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Jacket','typeOfChoice'=>'TextOptions', 'choice'=>['Wool','Cotton','Linen','Leather','Polyster','Polyurethane','Fleece','Nylon','Cashmere','Shearling','Other']],
            ['name'=>'theType', 'type'=>'ChoiceType', 'category'=>'Jacket','typeOfChoice'=>'TextOptions', 'choice'=>['Men','Women']],

            // Langerie
            ['name'=>'sSize', 'label'=>'Size','type'=>'ChoiceType', 'category'=>'Langerie','typeOfChoice'=>'TextOptions', 'choice'=>['XS','S','M','L','XL','XXL','XXXL']],
            ['name'=>'material', 'type'=>'TextType', 'category'=>'Langerie'],

            // Shoe
            ['name'=>'iSize', 'label'=>'Size','type'=>'ChoiceType', 'category'=>'Shoe','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>36,'max'=>48]],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Shoe','typeOfChoice'=>'TextOptions', 'choice'=>['Leather','Textiles','Synthetics','Rubber','Polyster','Foam','Other']],
            ['name'=>'theType', 'type'=>'ChoiceType', 'category'=>'Shoe','typeOfChoice'=>'TextOptions', 'choice'=>['Men','Women']],

            // Slide sandal
            ['name'=>'iSize', 'label'=>'Size','type'=>'ChoiceType', 'category'=>'Slide sandal','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>36,'max'=>48]],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Slide sandal','typeOfChoice'=>'TextOptions', 'choice'=>['Leather','Textiles','Synthetics','Rubber','Polyster','Foam','Other']],
            ['name'=>'theType', 'type'=>'ChoiceType', 'category'=>'Slide sandal','typeOfChoice'=>'TextOptions', 'choice'=>['Men','Women']],

            // Athletic shoe
            ['name'=>'iSize', 'label'=>'Size','type'=>'ChoiceType', 'category'=>'Athletic shoe','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>36,'max'=>48]],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Athletic shoe','typeOfChoice'=>'TextOptions', 'choice'=>['Leather','Textiles','Synthetics','Rubber','Polyster','Foam','Other']],
            ['name'=>'theType', 'type'=>'ChoiceType', 'category'=>'Athletic shoe','typeOfChoice'=>'TextOptions', 'choice'=>['Men','Women']],

            // fashion_Other
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'fashion_Other'],




            //homeAppliances-------------------------------------------------------------------------------------------
            //Refrigerator
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Refrigerator'],
            ['name'=>'minCapacity', 'label'=>'Capacity (liter)','type'=>'ChoiceType', 'category'=>'Refrigerator','typeOfChoice'=>'TextOptions', 'choice'=>['Less than 50 Liters'=> 1,'50-80 Liters'=> 2,'80-150 Liters'=> 3,'150-250 Liters'=> 4,'250-330 Liters'=>5,'330-490 Liters'=> 6,'More than 50 Liters'=>7]],
            ['name'=>'withFreezer', 'type'=>'CheckboxType', 'category'=>'Refrigerator'],


            //Cookers gas
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Cookers gas'],
            ['name'=>'fuelType','type'=>'ChoiceType', 'category'=>'Cookers gas','typeOfChoice'=>'TextOptions', 'choice'=>['City gas','Bottle gas']],
            ['name'=>'numberOfHead','type'=>'ChoiceType', 'category'=>'Cookers gas','typeOfChoice'=>'NumericOptions', 'choice'=>[1,2,3,4,5,6,7,8]],
            ['name'=>'withOven', 'type'=>'CheckboxType', 'category'=>'Cookers gas'],
            ['name'=>'electricHead', 'type'=>'CheckboxType', 'category'=>'Cookers gas'],

            //Cookers electric
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Cookers electric'],
            ['name'=>'numberOfHead','type'=>'ChoiceType', 'category'=>'Cookers electric','typeOfChoice'=>'NumericOptions', 'choice'=>[1,2,3,4,5,6,7,8]],
            ['name'=>'withOven', 'type'=>'CheckboxType', 'category'=>'Cookers electric'],

            //Gas plate
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Gas plate'],
            ['name'=>'numberOfHead','type'=>'ChoiceType', 'category'=>'Gas plate','typeOfChoice'=>'NumericOptions', 'choice'=>[1,2,3,4,5,6,7,8]],

            //Washing machine
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Washing machine'],
            ['name'=>'minCapacity', 'label'=>'Capacity (kg)','type'=>'ChoiceType', 'category'=>'Washing machine','typeOfChoice'=>'NumericOptions', 'choice'=>[3,4,5,6,7,8,9,10,12]],

            //Fan
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Fan'],

            //Coffee machine
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Coffee machine'],

            //Electric kettle
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Electric kettle'],

            //Vaccuum cleaner
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Vaccuum cleaner'],

            //Oven
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Oven'],

            //Blender
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Blender'],

            //Stand Mixer
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Stand Mixer'],

            //Dishwashers
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Dishwashers'],

            //Electric fryer
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Electric fryer'],

            //Freezer
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Freezer'],
            //Pressure cooker
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Pressure cooker'],

            //Heater
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Heater'],
            ['name'=>'fuelType', 'type'=>'ChoiceType', 'category'=>'Heater','typeOfChoice'=>'TextOptions', 'choice'=>['Gas','Diesel','fuelwood','Electric','Other']],

            //Iron
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Iron'],

            //Men's shaver
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Men\'s shaver'],

            //Lady shavers
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Lady shavers'],

            //Sandwich toaster
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Sandwich toaster'],

            //Meat grinder
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Meat grinder'],

            //Grilling charcoal
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Grilling charcoal'],

            //Hair dryer
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Hair dryer'],

            //Juicer machine
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Juicer machine'],

            //Electric vegetable
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Electric vegetable'],

            //Kitchen accessories
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Kitchen accessories'],

            //home_Other
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'home_Other'],



            //gardens--------------------------------------------------------------------------------------------------
            // Garden table
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Garden table','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Other']],

            // Swing
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Swing','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Other']],
            ['name'=>'numberOfPersson','type'=>'ChoiceType', 'category'=>'Swing','typeOfChoice'=>'NumericOptions', 'choice'=>[1,2,3,4,5,6,7,8]],

            // Seedlings
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Seedlings'],

            // Garden chair
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Garden chair','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Other']],
            ['name'=>'number', 'label'=>'Number (unit)','type'=>'ChoiceType', 'category'=>'Garden chair','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>50]],

            // Lawn mower
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Lawn mower'],

            // Chainsaw
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Chainsaw'],

            // Garden tools
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Garden tools'],

            // Fuelwood
            ['name'=>'material', 'type'=>'TextType', 'category'=>'Fuelwood'],

            // Electric generator
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Electric generator'],
            ['name'=>'fuelType', 'type'=>'ChoiceType', 'category'=>'Electric generator','typeOfChoice'=>'TextOptions', 'choice'=>['Diesel','Gasoline','Gas','Other']],

            // garden_Other
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'garden_Other'],






            //residences------------------------------------------------------------------------------------------------
            // Sell house
            ['name'=>'withFurniture', 'type'=>'CheckboxType', 'category'=>'Sell house'],
            ['name'=>'withGarden', 'type'=>'CheckboxType', 'category'=>'Sell house'],
            ['name'=>'area','label'=>'Area (m²)', 'type'=>'TextType', 'category'=>'Sell house'],
            ['name'=>'numberOfRooms','type'=>'ChoiceType', 'category'=>'Sell house','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>12]],
            ['name'=>'heatingType', 'type'=>'ChoiceType', 'category'=>'Sell house','typeOfChoice'=>'TextOptions', 'choice'=>['Diesel','Electricity','Fuelwood','Gas','Other']],

            // Sell apartment
            ['name'=>'withFurniture', 'type'=>'CheckboxType', 'category'=>'Sell apartment'],
            ['name'=>'withVerandah', 'type'=>'CheckboxType', 'category'=>'Sell apartment'],
            ['name'=>'withElevator', 'type'=>'CheckboxType', 'category'=>'Sell apartment'],
            ['name'=>'area','label'=>'Area (m²)', 'type'=>'TextType', 'category'=>'Sell apartment'],
            ['name'=>'numberOfRooms','type'=>'ChoiceType', 'category'=>'Sell apartment','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>12]],
            ['name'=>'heatingType', 'type'=>'ChoiceType', 'category'=>'Sell apartment','typeOfChoice'=>'TextOptions', 'choice'=>['Diesel','Electricity','Fuelwood','Gas','Other']],
            ['name'=>'heating', 'type'=>'ChoiceType', 'category'=>'Sell apartment','typeOfChoice'=>'TextOptions', 'choice'=>['Individually','Collective','Other']],

            // Sell office
            ['name'=>'withFurniture', 'type'=>'CheckboxType', 'category'=>'Sell office'],
            ['name'=>'withElevator', 'type'=>'CheckboxType', 'category'=>'Sell office'],
            ['name'=>'area','label'=>'Area (m²)', 'type'=>'TextType', 'category'=>'Sell office'],
            ['name'=>'numberOfRooms','type'=>'ChoiceType', 'category'=>'Sell office','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>12]],
            ['name'=>'heatingType', 'type'=>'ChoiceType', 'category'=>'Sell office','typeOfChoice'=>'TextOptions', 'choice'=>['Diesel','Electricity','Fuelwood','Gas','Other']],
            ['name'=>'heating', 'type'=>'ChoiceType', 'category'=>'Sell office','typeOfChoice'=>'TextOptions', 'choice'=>['Individually','Collective','Other']],

            // Sell shop
            ['name'=>'area','label'=>'Area (m²)', 'type'=>'TextType', 'category'=>'Sell shop'],
            ['name'=>'heatingType', 'type'=>'ChoiceType', 'category'=>'Sell shop','typeOfChoice'=>'TextOptions', 'choice'=>['Diesel','Electricity','Gas','Other']],

            // Sell car parking
            ['name'=>'covered', 'type'=>'CheckboxType', 'category'=>'Sell car parking'],

            // Sell farm
            ['name'=>'area','label'=>'Area (m²)', 'type'=>'TextType', 'category'=>'Sell farm'],

            // Rent house
            ['name'=>'withFurniture', 'type'=>'CheckboxType', 'category'=>'Rent house'],
            ['name'=>'withGarden', 'type'=>'CheckboxType', 'category'=>'Rent house'],
            ['name'=>'area','label'=>'Area (m²)', 'type'=>'TextType', 'category'=>'Rent house'],
            ['name'=>'numberOfRooms','type'=>'ChoiceType', 'category'=>'Rent house','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>12]],
            ['name'=>'heatingType', 'type'=>'ChoiceType', 'category'=>'Rent house','typeOfChoice'=>'TextOptions', 'choice'=>['Diesel','Electricity','Fuelwood','Gas','Other']],

            // Rent apartment
            ['name'=>'withFurniture', 'type'=>'CheckboxType', 'category'=>'Rent apartment'],
            ['name'=>'withVerandah', 'type'=>'CheckboxType', 'category'=>'Rent apartment'],
            ['name'=>'withElevator', 'type'=>'CheckboxType', 'category'=>'Rent apartment'],
            ['name'=>'area','label'=>'Area (m²)', 'type'=>'TextType', 'category'=>'Rent apartment'],
            ['name'=>'numberOfRooms','type'=>'ChoiceType', 'category'=>'Rent apartment','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>12]],
            ['name'=>'heatingType', 'type'=>'ChoiceType', 'category'=>'Rent apartment','typeOfChoice'=>'TextOptions', 'choice'=>['Diesel','Electricity','Fuelwood','Gas','Other']],
            ['name'=>'heating', 'type'=>'ChoiceType', 'category'=>'Rent apartment','typeOfChoice'=>'TextOptions', 'choice'=>['Individually','Collective','Other']],


            // Office rental
            ['name'=>'withElevator', 'type'=>'CheckboxType', 'category'=>'Office rental'],
            ['name'=>'area','label'=>'Area (m²)', 'type'=>'TextType', 'category'=>'Office rental'],
            ['name'=>'numberOfRooms','type'=>'ChoiceType', 'category'=>'Office rental','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>12]],
            ['name'=>'heatingType', 'type'=>'ChoiceType', 'category'=>'Office rental','typeOfChoice'=>'TextOptions', 'choice'=>['Diesel','Electricity','Fuelwood','Gas','Other']],
            ['name'=>'heating', 'type'=>'ChoiceType', 'category'=>'Office rental','typeOfChoice'=>'TextOptions', 'choice'=>['Individually','Collective','Other']],

            // Rent shop
            ['name'=>'area','label'=>'Area (m²)', 'type'=>'TextType', 'category'=>'Rent shop'],
            ['name'=>'heatingType', 'type'=>'ChoiceType', 'category'=>'Rent shop','typeOfChoice'=>'TextOptions', 'choice'=>['Diesel','Electricity','Gas','Other']],

            // Rent car parking
            ['name'=>'covered', 'type'=>'CheckboxType', 'category'=>'Rent car parking'],

            // Rent farm
            ['name'=>'area','label'=>'Area (m²)', 'type'=>'TextType', 'category'=>'Rent farm'],

            // Collective housing
            ['name'=>'theType', 'type'=>'ChoiceType', 'category'=>'Collective housing','typeOfChoice'=>'TextOptions', 'choice'=>['House','Apartment','Residential center','Other']],
            ['name'=>'withFurniture', 'type'=>'CheckboxType', 'category'=>'Collective housing'],
            ['name'=>'withElevator', 'type'=>'CheckboxType', 'category'=>'Collective housing'],
            ['name'=>'numberOfRooms','type'=>'ChoiceType', 'category'=>'Collective housing','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>12]],
            ['name'=>'heatingType', 'type'=>'ChoiceType', 'category'=>'Collective housing','typeOfChoice'=>'TextOptions', 'choice'=>['Diesel','Electricity','Fuelwood','Gas','Other']],

            // residence_Other
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'residence_Other'],


            //jewelrys---------------------------------------------------------------------------------------------------
            // Necklaces
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Necklaces','typeOfChoice'=>'TextOptions', 'choice'=>['Silver','Silver filled','Yellow gold','White gold','Rose gold','Green gold','Base Metal','Platinum','Titanium','gemstone','mixed','Other']],

            // Collier
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Collier','typeOfChoice'=>'TextOptions', 'choice'=>['Silver','Silver filled','Yellow gold','White gold','Rose gold','Green gold','Base Metal','Platinum','Titanium','gemstone','mixed','Other']],

            // Bracelet
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Bracelet','typeOfChoice'=>'TextOptions', 'choice'=>['Silver','Silver filled','Yellow gold','White gold','Rose gold','Green gold','Base Metal','Platinum','Titanium','gemstone','mixed','Other']],

            // Ring
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Ring','typeOfChoice'=>'TextOptions', 'choice'=>['Silver','Silver filled','Yellow gold','White gold','Rose gold','Green gold','Base Metal','Platinum','Titanium','gemstone','mixed','Other']],
            ['name'=>'iSize', 'label'=>'Siz Of Ring','type'=>'ChoiceType', 'category'=>'Ring','typeOfChoice'=>'NumericOptions', 'choice'=>[45,47,50,53,57,60,63,66,69]],

            // Watch
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Watch'],
            ['name'=>'analogDigital', 'type'=>'ChoiceType', 'category'=>'Watch','typeOfChoice'=>'TextOptions', 'choice'=>['Analogue','Digital','Other']],
            // Earrings
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Earrings','typeOfChoice'=>'TextOptions', 'choice'=>['Silver','Silver filled','Yellow gold','White gold','Rose gold','Green gold','Base Metal','Platinum','Titanium','gemstone','mixed','Other']],

            // Perfumes
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Perfumes'],

            // Wine
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Wine'],
            ['name'=>'minCapacity', 'label'=>'Capacity (ml)', 'type'=>'ChoiceType', 'category'=>'Wine','typeOfChoice'=>'NumericOptions', 'choice'=>[100,187,375,750,1000,1500,3000]],
            ['name'=>'manufacturingYear', 'type'=>'ChoiceType', 'category'=>'Wine','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1890,'max'=>$thisYear]],
            ['name'=>'originCountry', 'type'=>'ChoiceType', 'category'=>'Wine','typeOfChoice'=>'TextOptions', 'choice'=>['France','Italy','Spain','Chile','Australia','United States','Germany','New zealand','Portugal','Argentina','Croatia','Switzerland','Other']],

            // jewelry_Other
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'jewelry_Other'],


            //musics---------------------------------------------------------------------------------------------------
            // Piano
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Piano'],
            ['name'=>'manufacturingYear', 'type'=>'ChoiceType', 'category'=>'Piano','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1920,'max'=>$thisYear]],
            // Violin
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Violin'],
            ['name'=>'manufacturingYear', 'type'=>'ChoiceType', 'category'=>'Violin','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1920,'max'=>$thisYear]],

            // Trumpet
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Trumpet'],
            ['name'=>'manufacturingYear', 'type'=>'ChoiceType', 'category'=>'Trumpet','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1920,'max'=>$thisYear]],

            // Flute
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Flute'],
            ['name'=>'manufacturingYear', 'type'=>'ChoiceType', 'category'=>'Flute','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1920,'max'=>$thisYear]],

            // Clarinet
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Clarinet'],
            ['name'=>'manufacturingYear', 'type'=>'ChoiceType', 'category'=>'Clarinet','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1920,'max'=>$thisYear]],

            // Drums
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Drums'],
            ['name'=>'manufacturingYear', 'type'=>'ChoiceType', 'category'=>'Drums','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1920,'max'=>$thisYear]],

            // Cello
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Cello'],
            ['name'=>'manufacturingYear', 'type'=>'ChoiceType', 'category'=>'Cello','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1920,'max'=>$thisYear]],

            // Contrabass
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Contrabass'],
            ['name'=>'manufacturingYear', 'type'=>'ChoiceType', 'category'=>'Contrabass','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1920,'max'=>$thisYear]],

            // Electric guitar
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Electric guitar'],
            ['name'=>'manufacturingYear', 'type'=>'ChoiceType', 'category'=>'Electric guitar','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1940,'max'=>$thisYear]],

            // Classic guitar
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Classic guitar'],
            ['name'=>'manufacturingYear', 'type'=>'ChoiceType', 'category'=>'Classic guitar','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1920,'max'=>$thisYear]],

            // Digital keyboard
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Digital keyboard'],
            ['name'=>'manufacturingYear', 'type'=>'ChoiceType', 'category'=>'Digital keyboard','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1920,'max'=>$thisYear]],

            // Accordion
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Accordion'],
            ['name'=>'manufacturingYear', 'type'=>'ChoiceType', 'category'=>'Accordion','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1920,'max'=>$thisYear]],

            // Music accessories
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Music accessories'],

            // music_Other
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'music_Other'],


            //sports--------------------------------------------------------------------------------------------------
            // Ski boots
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Ski boots'],
            ['name'=>'iSize', 'label'=>'Size', 'type'=>'ChoiceType', 'category'=>'Ski boots','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>32,'max'=>48]],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Ski boots','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],

            // Roller skating
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Roller skating'],
            ['name'=>'iSize', 'label'=>'Size', 'type'=>'ChoiceType', 'category'=>'Roller skating','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>32,'max'=>48]],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Roller skating','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],

            // Parachute
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Parachute'],

            // Swimming glasses
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Swimming glasses'],

            // Football
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Football'],

            // Basketball
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Basketball'],

            // Iron balls
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Iron balls'],
            ['name'=>'number', 'label'=>'Number (unit)','type'=>'ChoiceType', 'category'=>'Iron balls','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>30]],

            // Volley ball
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Volley ball'],

            // American football
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'American football'],

            // Sports tool
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Sports tool'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Sports tool','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],

            // Bicycle
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Bicycle'],
            ['name'=>'model', 'type'=>'TextType', 'category'=>'Bicycle'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Bicycle','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],

            // Bicycle accessories
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Bicycle accessories'],
            ['name'=>'generalSituation', 'type'=>'ChoiceType', 'category'=>'Bicycle accessories','typeOfChoice'=>'TextOptions', 'choice'=>['Damaged'=> 1,'Medium'=> 2,'Good' => 3,'Semi-new'=> 4,'Totally new'=> 5]],

            // sport_Other
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'sport_Other'],

            //Pets-----------------------------------------------------------------------------------------------------
            //  Cat
            ['name'=>'age', 'label'=>'Age (year)', 'type'=>'TextType', 'category'=>'Cat'],
            ['name'=>'animalSpecies', 'type'=>'TextType', 'category'=>'Cat'],

            // Dog
            ['name'=>'age', 'label'=>'Age (year)', 'type'=>'TextType', 'category'=>'Dog'],
            ['name'=>'animalSpecies', 'type'=>'TextType', 'category'=>'Dog'],

            // Hamster
            ['name'=>'age', 'label'=>'Age (year)', 'type'=>'TextType', 'category'=>'Hamster'],
            ['name'=>'animalSpecies', 'type'=>'TextType', 'category'=>'Hamster'],

            // Mouse
            ['name'=>'age', 'label'=>'Age (year)', 'type'=>'TextType', 'category'=>'Mouse'],
            ['name'=>'animalSpecies', 'type'=>'TextType', 'category'=>'Mouse'],

            // pet_Other
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'pet_Other'],
            ['name'=>'age', 'label'=>'Age (year)', 'type'=>'TextType', 'category'=>'pet_Other'],
            ['name'=>'animalSpecies', 'type'=>'TextType', 'category'=>'pet_Other'],




            //kids------------------------------------------------------------------------------------------------------
            //  Crib
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Crib'],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Crib','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Other']],

            // kids_Chest of drawers
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'kids_Chest of drawers'],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'kids_Chest of drawers','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Other']],

            // Stroller
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Stroller'],

            // Diapers
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Diapers'],
            ['name'=>'iSize', 'label'=>'Size', 'type'=>'ChoiceType', 'category'=>'Diapers','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>0,'max'=>8]],

            // kids_Mattress
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'kids_Mattress'],

            // Baby clothes
            ['name'=>'iSize', 'label'=>'Size', 'type'=>'ChoiceType', 'category'=>'Baby clothes','typeOfChoice'=>'NumericOptions', 'choice'=>[40,44,50,54,60,67,71,74,81,86,94,102,108,116,122,128,134,140,146,152,158,164,170,174,180]],
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Baby clothes'],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Baby clothes','typeOfChoice'=>'TextOptions', 'choice'=>['Cotton','Cloth','Polyester','Linen','Jeans','Wool','Silk','Other']],

            // Baby tools
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Baby tools'],
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Baby tools'],
            ['name'=>'age', 'type'=>'ChoiceType', 'category'=>'Baby tools','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>15]],

            // Baby toys
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Baby toys'],
            ['name'=>'manufactureCompany', 'type'=>'TextType', 'category'=>'Baby toys'],
            ['name'=>'age', 'type'=>'ChoiceType', 'category'=>'Baby toys','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>15]],

            // kid_Other
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'kid_Other'],



            // furnitures-----------------------------------------------------------------------------------------------
            //  Couch
            ['name'=>'numberOfPersson', 'type'=>'ChoiceType', 'category'=>'Couch','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>5]],
            ['name'=>'coverMaterial', 'type'=>'ChoiceType', 'category'=>'Couch','typeOfChoice'=>'TextOptions', 'choice'=>['Cotton','Cloth','Leather','Linen','Velvet','Chamois','Other']],

            // Dining table
            ['name'=>'numberOfPersson', 'type'=>'ChoiceType', 'category'=>'Dining table','typeOfChoice'=>'NumericOptions', 'choice'=>[2,4,6,8,10,12,14]],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Dining table','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Other']],
            ['name'=>'shape', 'type'=>'ChoiceType', 'category'=>'Dining table','typeOfChoice'=>'TextOptions', 'choice'=>['Oval','Circular','Square','Rectangle','Complex','Other']],

            // Chest of drawers

            ['name'=>'numberOfDrawer', 'type'=>'ChoiceType', 'category'=>'Chest of drawers','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>12]],
            ['name'=>'numberOfStaging', 'type'=>'ChoiceType', 'category'=>'Chest of drawers','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>12]],
            ['name'=>'numberOfDoors', 'type'=>'ChoiceType', 'category'=>'Chest of drawers','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>12]],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Chest of drawers','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Other']],

            // Closet

            ['name'=>'numberOfDrawer', 'type'=>'ChoiceType', 'category'=>'Closet','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>12]],
            ['name'=>'numberOfStaging', 'type'=>'ChoiceType', 'category'=>'Closet','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>12]],
            ['name'=>'numberOfDoors', 'type'=>'ChoiceType', 'category'=>'Closet','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>12]],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Closet','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Other']],

            // Central table

            ['name'=>'shape', 'type'=>'ChoiceType', 'category'=>'Central table','typeOfChoice'=>'TextOptions', 'choice'=>['Oval','Circular','Square','Rectangle','Complex','Other']],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Central table','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Other']],

            // Bed

            ['name'=>'numberOfPersson', 'type'=>'ChoiceType', 'category'=>'Bed','typeOfChoice'=>'TextOptions', 'choice'=>['1'=>1,'1.5'=>1.5,'2'=>2]],
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Bed','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Mixed','Other']],

            // Mattress'
            ['name'=>'brand', 'type'=>'TextType', 'category'=>'Mattress'],
            ['name'=>'numberOfPersson', 'type'=>'ChoiceType', 'category'=>'Mattress','typeOfChoice'=>'TextOptions', 'choice'=>['1'=>1,'1.5'=>1.5,'2'=>2]],

            //Quilt
            ['name'=>'numberOfPersson', 'type'=>'ChoiceType', 'category'=>'Quilt','typeOfChoice'=>'TextOptions', 'choice'=>['1'=>1,'1.5'=>1.5,'2'=>2]],

            //Carpet

            ['name'=>'shape', 'type'=>'ChoiceType', 'category'=>'Carpet','typeOfChoice'=>'TextOptions', 'choice'=>['Oval','Circular','Square','Rectangle','Complex','Other']],

            //Chair
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Chair','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Mixed','Other']],
            ['name'=>'number', 'label'=>'Number (unit)', 'type'=>'ChoiceType', 'category'=>'Chair','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>12]],

            //Office chair
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Office chair','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Mixed','Other']],
            ['name'=>'number', 'label'=>'Number (unit)', 'type'=>'ChoiceType', 'category'=>'Office chair','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>12]],

            //Sofa
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Sofa','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Mixed','Other']],
            ['name'=>'number', 'label'=>'Number (unit)', 'type'=>'ChoiceType', 'category'=>'Sofa','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>12]],

            //Racks

            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Racks','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Mixed','Other']],

            //Study table

            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Study table','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Mixed','Other']],

            //Click clack

            ['name'=>'numberOfPersson', 'type'=>'ChoiceType', 'category'=>'Click clack','typeOfChoice'=>'NumericOptions', 'choice'=>[1,2,3,4]],

            //Nightstand

            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Nightstand','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Mixed','Other']],
            ['name'=>'numberOfDrawer', 'type'=>'ChoiceType', 'category'=>'Nightstand','typeOfChoice'=>'NumericOptions', 'choice'=>[1,2,3,4]],

            //Shoe cabinet

            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Shoe cabinet','typeOfChoice'=>'TextOptions', 'choice'=>['Metal','Wood','Plastic','Mixed','Other']],
            ['name'=>'numberOfDrawer', 'type'=>'ChoiceType', 'category'=>'Shoe cabinet','typeOfChoice'=>'NumericOptions', 'choice'=>[1,2,3,4,5,6,7,8]],

            //Chandelier
            ['name'=>'material', 'type'=>'ChoiceType', 'category'=>'Chandelier','typeOfChoice'=>'TextOptions', 'choice'=>['Glass','Crystal','Carton','Funt','Metal','Wood','Plastic','Mixed','Other']],

            //Antic
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Antic'],

            //Painting

            //Roses
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'Roses'],

            //Curtain

            //Floor lamp

            //Mirror

            //furniture_Other
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'furniture_Other'],


            //holidays--------------------------------------------------------------------------------------------------
            //  Camp

            // Hotel

            // Cottage

            // Chalet
            ['name'=>'numberOfRooms','type'=>'ChoiceType', 'category'=>'Chalet','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>12]],

            // Cards and reservations

            ['name'=>'eventType', 'label' => 'All type of events', 'type'=>'ChoiceType', 'category'=>'Cards and reservations','typeOfChoice'=>'TextOptions', 'choice'=>['Music','Cinema','Sport','Theater','Party','Resturant','Tourist','Travel']],
            ['name'=>'numberOfPersson', 'type'=>'ChoiceType', 'category'=>'Cards and reservations','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>8]],
            ['name'=>'number', 'label'=>'Number (unit)', 'type'=>'ChoiceType', 'category'=>'Cards and reservations','typeOfChoice'=>'SequentialNumericOptions', 'choice'=>['min'=>1,'max'=>10]],


            // holiday_Other
            ['name'=>'subjectName', 'type'=>'TextType', 'category'=>'holiday_Other'],

        ];


        foreach ($specificationOffer as $category){
            $this->addFields($manager,$category,'Offer');
        }
        foreach ($specificationDemand as $category){
            $this->addFields($manager,$category,'Demand');
        }

        foreach ($specificationSearchOffer as $category){
            $this->addFields($manager,$category,'SearchOffer');
        }
        foreach ($specificationSearchDemand as $category){
            $this->addFields($manager,$category,'SearchDemand');
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
        ];
    }

    public function addFields(ObjectManager $manager, array $choice, $typeOfCategory){
        $name = $choice['name'];
        $category = $choice['category'].'_'.$typeOfCategory;
        $type = $choice['type'];

        if($type === 'TextType'){
            $spe = new Specification($name);
            $spe->setType('TextType');
            if(isset($choice['label'])) {
                $spe->setLabel($choice['label']);
            }
        }
        elseif($type === 'CheckboxType'){
            $spe = new Specification($name);
            $spe->setType('CheckboxType');
            if(isset($choice['label'])) {
                $spe->setLabel($choice['label']);
            }
        }
        elseif($type === 'ColorType'){
            $spe = new Specification($name);
            $spe->setType('ColorType');
            if(isset($choice['label'])) {
                $spe->setLabel($choice['label']);
            }
        }
        elseif($type === 'EntityType'){
            $spe = new Specification($name);
            $spe->setType('EntityType');
            if(isset($choice['label'])) {
                $spe->setLabel($choice['label']);
            }
        }
        elseif($type === 'DateType'){
            $spe = new Specification($name);
            $spe->setType('DateType');
            if(isset($choice['label'])) {
                $spe->setLabel($choice['label']);
            }
        }
        elseif($type === 'ChoiceType'){

            $typeOfChoice = $choice['typeOfChoice'];
            $choiceOptions = $choice['choice'];
            $spe = new Specification($name);
            $spe->setType('ChoiceType');
            $spe->setTypeOfChoice($typeOfChoice);
            if(isset($choice['label'])) {
                $spe->setLabel($choice['label']);
            }
            if($typeOfChoice === 'TextOptions'){
                $spe->setTextOptions($choiceOptions);
            }
            elseif($typeOfChoice === 'NumericOptions'){
                $spe->setNumericOptions($choiceOptions);
            }
            elseif($typeOfChoice === 'SequentialNumericOptions'){
                $min = $choiceOptions['min'];
                $max = $choiceOptions['max'];
                $spe->setMinOption($min);
                $spe->setMaxOption($max);
            }
        }

        $spe->setCategory($this->getReference($category));

        $manager->persist($spe);
    }
}
