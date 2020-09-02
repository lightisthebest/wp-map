(function () {
    let mapDiv = document.getElementById('map-vue');
    if (mapDiv) {
        new Vue({
            el: '#map-vue',
            data: {
                map: {
                    key: '',
                    lat: 0,
                    lng: 0,
                    zoom: 9,
                    styles: '[{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#444444"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2f2f2"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#46bcec"},{"visibility":"on"}]}]'
                },
                mapUrl: '/?rest_route=/my-map/api/map'
            },
            methods: {
                async getMap() {
                    try {
                        let response = await axios.get(this.mapUrl);
                        if (response.status === 200 && (typeof response.data) === "object") {
                            this.map = response.data;
                        }
                    } catch (error) {
                    }
                },
                async sendMap() {
                    try {
                        let response = await axios.post(this.mapUrl, this.map);
                    } catch (error) {
                    }
                }
            },
            created() {
                this.getMap();
            }
        });
    } else {
        let tabDiv = document.getElementById('map-tabs');
        if (tabDiv) {
            new Vue({
                el: '#map-tabs',
                data: {
                    tabs: [],
                    tabsUrl: '/?rest_route=/my-map/api/tabs'
                },
                methods: {
                    async getTabs() {
                        try {
                            let response = await axios.get(this.tabsUrl);
                            if (response.status === 200 && (typeof response.data) === "object") {
                                this.tabs = response.data;
                            }
                        } catch (error) {
                        }
                    },
                    async sendTabs() {
                        try {
                            let response = await axios.post(this.tabsUrl, this.tabs);
                        } catch (error) {
                        }
                    }
                },
                created() {
                    this.getTabs();
                }
            });
        }
    }
})();