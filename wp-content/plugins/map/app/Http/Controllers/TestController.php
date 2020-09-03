<?php


namespace App\Http\Controllers;


class TestController
{
    public function do() {
        $data = [
                    [
                        'id'=> 1,
                        'tabTitle'=> 'Test',
                        'places'=> [
                            [
                                'id'=> 1,
                                'placeTitle'=> 'Devseonet',
                                'lat'=> 50.737213,
                                'lng'=> 25.366427,
                                'contentString' => '<div id="content">'.
                            '<div id="siteNotice">'.
                            '</div>'.
                            '<h1 id="firstHeading" class="firstHeading">Devseonet</h1>'.
                            '<div id="bodyContent">'.
                            '<p>Наша фірма</p>'.
                            '<p><b>Веб-сайт=></b> <a href="https=>//devseonet.com" target="_blank">devseonet.com</a>'.
                            '</p>'.
                            '</div>'.
                            '</div>'
                            ]
                        ]
                    ]
                ];
        return response()->json($data);
        return 'ok';
    }
}