<?php
class NewsCommand extends CConsoleCommand {

    public function actionGenerate() {
        // TODO:: Придется немного подождать, нужно реализовать в несколько потоков
        for ($i=0; $i<100; $i++) {
            $objNews = new News();
            $objNews->title = 'title_' . $i;
            $objNews->save();
        }
    }
} 