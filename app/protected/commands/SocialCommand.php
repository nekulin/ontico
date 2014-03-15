<?php
class SocialCommand extends CConsoleCommand {

    public function actionGenerate() {
        // Добавим студентов
        Students::model()->deleteAll();
        $attrStudentsId = array();
        for ($i=0; $i<1000; $i++) {
            $objStudent = new Students();
            $objStudent->name = 'name_' . $i;
            $objStudent->grade = rand(1, 5);
            $objStudent->save();
            $attrStudentsId[] = $objStudent->id;
        }
        $intCountStudent = count($attrStudentsId);
        $intCountStudent--;
        // Добавим лайки
        for ($i=0; $i<100; $i++) {
            $objLike = new Likes();
            $objLike->like_id = $attrStudentsId[rand(0, $intCountStudent)];
            $objLike->liked_id = $attrStudentsId[rand(0, $intCountStudent)];
            while ($objLike->liked_id==$objLike->like_id) {
                $objLike->liked_id = $attrStudentsId[rand(0, $intCountStudent)];
            }
            $objLike->save();
        }
    }

    /**
     * Получить имена и средний балл всех студентов, которые были
     * лайкнуты более чем одним студентом.
     */
    public function actionA() {
        // TODO:: Можно вынести запрос в модель и получить через статический метод
        $criteria = new CDbCriteria();
        $criteria->alias = "s";
        $criteria->addCondition("
            s.id IN (
                SELECT liked_id FROM ". Likes::model()->tableName() ." l
                WHERE l.liked_id=s.id
                HAVING count(*)>1
            )
        ");
        /** @var Students[] $attrStudents */
        $attrStudents = Students::model()->findAll($criteria);
        if ($attrStudents) {
            foreach ($attrStudents as $objStudent) {
                echo $objStudent->name . ' ' . $objStudent->grade . PHP_EOL;
            }
        }
    }

    /**
     * Получить имена и средний балл студентов А, которые лайкнули
     * студентов В, но при этом студенты В не поставили лайк ни на одной из страниц
     * других студентов.
     */
    public function actionB() {
        // TODO:: Можно вынести запрос в модель и получить через статический метод
        $criteria = new CDbCriteria();
        $criteria->addCondition("
            id IN (
                SELECT l.like_id FROM ". Likes::model()->tableName() ." l
                LEFT JOIN ". Likes::model()->tableName() ." l2 ON l2.like_id=l.liked_id
                WHERE l2.liked_id IS NULL
            )
        ");
        /** @var Students[] $attrStudents */
        $attrStudents = Students::model()->findAll($criteria);
        if ($attrStudents) {
            foreach ($attrStudents as $objStudent) {
                echo $objStudent->name . ' ' . $objStudent->grade . PHP_EOL;
            }
        }
    }

    /**
     * Вернуть имена и средний балл всех студентов, которые не лайкали чужие
     * страницы и не были лайкнуты другими пользователями.
     */
    public function actionC() {
        // TODO:: Можно вынести запрос в модель и получить через статический метод
        $criteria = new CDbCriteria();
        $criteria->alias = "s";
        $criteria->join = "
         LEFT JOIN ". Likes::model()->tableName() ." l ON l.like_id=s.id
         LEFT JOIN ". Likes::model()->tableName() ." l2 ON l2.liked_id=s.id
        ";
        $criteria->addCondition("l.like_id IS NULL and l2.like_id IS NULL");
        /** @var Students[] $attrStudents */
        $attrStudents = Students::model()->findAll($criteria);
        if ($attrStudents) {
            foreach ($attrStudents as $objStudent) {
                echo $objStudent->name . ' ' . $objStudent->grade . PHP_EOL;
            }
        }
    }
} 