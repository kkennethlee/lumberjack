<?php
namespace app\controllers;

class LogController extends \erdiko\controllers\Web
{
    
    use \erdiko\theme\traits\Controller;

    /**
     *
     *
     */
    public function get($request, $response, $args)
    {
        $logService = new \app\models\LogService($this->container->em);
        $events = $logService->getEvents();

        $logEvents = array();
        foreach ($events as $event){
            $res['eventID'] = $event->getId();
            $res['description'] = $event->getDescription();
            $res['name'] = $event->getName();
            $res['href'] = '/log/detail/' . $res['eventID'];
            $res['image_src'] = 'https://lorempixel.com/600/300/food/5/';
            $res['latest_update'] = "Last update by aPerson x minutes ago";
            $logEvents[] = $res;
        }

        $view = 'layouts/log.html';
        $themeData['theme'] = \erdiko\theme\Config::get($this->container->get('settings')['theme']);

        /*
        title
        eventID
        description
        image_src
        latest_update
        href
        */

        $themeData['page'] =  [
            'title' => "This is the Log Index Controller",
            'description' => "This is where all the log that were previously created",
            'logevents' => $logEvents
        ];

        return $this->container->theme->render($response, $view, $themeData);
    }

    /**
     *
     *
     */
    public function getDetail($request, $response, $args)
    {
        $this->container->logger->debug("/controller");
        $view = 'layouts/logdetail.html';

        $themeData['theme'] = \erdiko\theme\Config::get($this->container->get('settings')['theme']);
        $eventID = (int)$args['param'];
        
        $this->container->logger->debug("param: ".$eventID);

        $themeData['page'] = [
            'title' => "Custom Log Stuff",
            'description' => "Description of the log you just clicked yourself.",
            'entries' => [
                
            ]
        
        ];

        //GET METHOD


        switch ($eventID) {
            case 0:
                //echo "i equals 0";
                die('nuthin');
                $themeData['page']['description'] = "There is nothing here";
                break;
            case 1:
                //echo "i equals 1";
                $themeData['page']['entries'] = [[
                        'time' => "12:00:00",
                        'userID' => 20,
                        'message' => "Morty has walked 45 miles today"
                    ], 
                    [
                        'time' => "1:00:00",
                        'userID' => 21,
                        'message' => "Rick has walked 2 miles today"
                    ]];
                $themeData['page']['description'] = "this is event log for " . $eventID;
                break;
            case 2:
                //echo "i equals 2";
                $themeData['page']['entries'] = [[
                        'time' => "2:00:00",
                        'userID' => 20,
                        'message' => "Morty's blood alcohol level is at 0%"
                    ], 
                    [
                        'time' => "3:00:00",
                        'userID' => 21,
                        'message' => "Rick's blood alcohol level is at 20%"
                    ]];
                $themeData['page']['description'] = "this is event log for " . $eventID;
                break;
            case 3:
                //echo "i equals 2";
                $themeData['page']['entries'] = [[
                        'time' => "4:00:00",
                        'userID' => 20,
                        'message' => "Morty's math grade is at 4%"
                    ], 
                    [
                        'time' => "5:00:00",
                        'userID' => 21,
                        'message' => "Rick's math grade is a at 100%"
                    ]];
                $themeData['page']['description'] = "this is event log for " . $eventID;
                break;
            default:
                die('nuthin');
                $themeData['page']['description'] = "There is nothing here"; 
        }
    
        return $this->container->theme->render($response, $view, $themeData);
    }

}
