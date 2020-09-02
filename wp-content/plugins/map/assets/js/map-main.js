(function () {
    let mapDiv = document.getElementById('map-vue');
    if (mapDiv) {
        new Vue({
            el: '#map-vue',
            data : {
                key : 'AIzaSyBdDxXaKJJOG3mqd-ZKcBtoOoXN3BfFN8c',
                lat: 51.130194,
                lng: 24.8508403,
                zoom: 9,
                styles: '[{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#444444"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2f2f2"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#46bcec"},{"visibility":"on"}]}]'
            },
            methods: {

            }
        });
    }










    let tabDiv = document.getElementById('map-tabs');
    if (tabDiv) {
        new Vue ({
            el: '#map-tabs',
            data: {
                tabs: [
                    {
                        id: 1,
                        tabTitle: 'Test',
                        places: [
                            {
                                id: 1,
                                placeTitle: 'Devseonet',
                                lat: 50.737213,
                                lng: 25.366427,
                                contentString: '<div id="content">'+
                                    '<div id="siteNotice">'+
                                    '</div>'+
                                    '<h1 id="firstHeading" class="firstHeading">Devseonet</h1>'+
                                    '<div id="bodyContent">'+
                                    '<p>Наша фірма</p>'+
                                    '<p><b>Веб-сайт:</b> <a href="https://devseonet.com" target="_blank">devseonet.com</a>'+
                                    '</p>'+
                                    '</div>'+
                                    '</div>'
                            }
                        ]
                    }
                ]
            }
        });
    }
})();