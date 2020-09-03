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
                mapUrl: '/?rest_route=/my-map/api/map',
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
                        if (response.status === 200) {
                            location.reload();
                        }
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
                    counter: 0,
                    tabs: [{
                        id: 1,
                        tabTitle: '',
                        places: [{
                            id: 1,
                            placeTitle: '',
                            lat: 0,
                            lng: 0,
                            contentString: ''
                        }]
                    }],
                    tabsUrl: '/?rest_route=/my-map/api/tabs',
                },
                methods: {
                    async getTabs() {
                        try {
                            let response = await axios.get(this.tabsUrl);
                            if (response.status === 200) {
                                this.tabs = typeof response.data === "string" ? JSON.parse(response.data) : response.data;
                                let tabIndex = 1;
                                for (let i = 0; i < this.tabs.length; i++) {
                                    this.tabs[i].id = tabIndex++;
                                    this.tabs[i].active = this.tabs[i].id === 1;
                                    if (this.tabs[i].places.length) {
                                        let placeIndex = 1;
                                        this.tabs[i].places.forEach(place => place.id = placeIndex++)
                                    }
                                }
                            }
                        } catch (error) {
                        }
                    },
                    async sendTabs() {
                        try {
                            let response = await axios.post(this.tabsUrl, this.tabs);
                            if (response.status === 200) {
                                location.href = location.href;
                            }
                        } catch (error) {
                        }
                    },
                    addNewTab() {
                        let newTab = {
                            id: this.tabs.length === 0 ? 1 : (this.tabs[this.tabs.length - 1].id + 1),
                            tabTitle: 'Нова вкладка',
                            places: [{
                                id: 1,
                                placeTitle: '',
                                lat: 0,
                                lng: 0,
                                contentString: ''
                            }]
                        };
                        this.tabs.push(newTab);
                        this.makeActive(newTab.id);
                    },
                    makeActive(id) {
                        this.tabs.forEach((item, index) => {
                            this.$set(this.tabs[index], 'active', item.id === id)

                        });
                    },
                    removeTab(id) {
                        if (this.tabs.length) {
                            let index = this.tabs.findIndex(tab => tab.id === id);
                            if (index !== -1) {
                                this.tabs.splice(index, 1);
                            }
                            index = -1;
                        }
                    },
                    addPlace(tabId) {
                        if (this.tabs.length && tabId) {
                            this.tabs.forEach((tab, index) => {
                                if (tab.id === tabId) {
                                    let places = tab.places;
                                    places.push({
                                        id: places.length === 0 ? 1 : (places[places.length - 1].id + 1),
                                        placeTitle: '',
                                        lat: 0,
                                        lng: 0,
                                        contentString: ''
                                    });
                                    this.$set(this.tabs[index], 'places', places);
                                }
                            });
                        }
                    },
                    removePlace(tabId, placeId) {
                        if (this.tabs.length && tabId && placeId) {
                            this.tabs.forEach((tab, index) => {
                                if (tab.id === tabId) {
                                    let places = tab.places;
                                    if (places.length) {
                                        let placeIndex = places.findIndex(place => place.id === placeId);
                                        if (placeIndex !== -1) {
                                            places.splice(placeIndex, 1);
                                        }
                                        placeIndex = -1;
                                    }
                                    this.$set(this.tabs[index], 'places', places)
                                }
                            });
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