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
    }

    let tabDiv = document.getElementById('map-tabs');
    if (tabDiv) {
        new Vue({
            el: '#map-tabs',
            components: {
                // Use the <ckeditor> component in this view.
                ckeditor: CKEditor.component
            },
            data: {
                editor: ClassicEditor,
                editorConfig: {
                    toolbar: [
                        "bold", "italic", "undo", "redo", "blockQuote", "heading",
                        "indent", "outdent", "link", "numberedList", "bulletedList"]
                },
                counter: 0,
                tabs: [{
                    id: 1,
                    tabTitle: '',
                    places: [{
                        id: 1,
                        placeTitle: '',
                        category: 0,
                        lat: 0,
                        lng: 0,
                        contentString: ''
                    }]
                }],
                categories: [],
                tabsUrl: '/?rest_route=/my-map/api/tabs',
            },
            methods: {
                async getTabs() {
                    try {
                        let response = await axios.get(this.tabsUrl);
                        if (response.status === 200) {
                            this.tabs = typeof response.data.tabs === "string" ? JSON.parse(response.data.tabs) : response.data.tabs;
                            this.categories = typeof response.data.categories.categories === "string" ? JSON.parse(response.data.categories.categories) : response.data.categories.categories;
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
                            category: 0,
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
                                    category: 0,
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

    let myMap = document.getElementById('my-map');
    if (myMap) {
        new Vue({
            el: '#my-map',
            data: {
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
                map: {
                    key: '',
                    lat: 0,
                    lng: 0,
                    zoom: 9,
                    styles: '[{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#444444"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2f2f2"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#46bcec"},{"visibility":"on"}]}]'
                },
                url: '/?rest_route=/my-map/api/full-map',
                createNewMaps: true
            },
            methods: {
                makeActive(id) {
                    this.tabs.forEach((item, index) => {
                        this.$set(this.tabs[index], 'active', item.id === id)
                    });
                },
                getInfo() {
                    let response = axios.get(this.url).then(response => {
                        if (response.status === 200) {
                            let ttt = typeof response.data === "string" ? JSON.parse(response.data.tabs) : response.data.tabs;
                            this.$set(this, 'tabs', ttt);
                            this.map = response.data.map;
                        }
                    }).catch(error => {
                        console.log(error);
                    });
                },
                createMarker(place, map) {
                    let marker = new google.maps.Marker({
                        position: {lat: place.lat * 1, lng: place.lng * 1},

                        map: map,

                        title: place.title,

                        icon: place.icon
                    });

                    let infowindow = new google.maps.InfoWindow({
                        content: place.contentString,
                        maxWidth: 400
                    });

                    marker.addListener('click', function () {
                        infowindow.open(map, marker);
                    });
                }
            },
            mounted() {
                this.getInfo();
            },
            updated() {
                if (this.createNewMaps) {

                    //Creating google map for each tab
                    this.tabs.forEach((tab, index) => {
                        let m = document.getElementById('google-map-' + tab.id);

                        if (m && !tab.googleMap) {
                            try {
                                let mapStyles = typeof this.map.styles === 'string' ? JSON.parse(this.map.styles) : this.map.styles;

                                let gMap = new google.maps.Map(m, {
                                    center: {lat: this.map.lat * 1, lng: this.map.lng * 1},
                                    zoom: this.map.zoom * 1,
                                    styles: mapStyles
                                });
                                this.$set(this.tabs[index], 'googleMap', gMap);

                                tab.places.forEach(place => this.createMarker(place, tab.googleMap));


                            } catch (error) {
                                console.log(error);
                            }
                        }
                    });
                    this.showContent = false;
                }

            }
        });

    }


    let catDiv = document.getElementById('map-categories');
    if (catDiv) {
        new Vue({
            el: '#map-categories',
            data: {
                categories: [{
                    id: 1,
                    title: ''
                }],
                url: '/?rest_route=/my-map/api/categories',
                lastId: 1
            },
            methods: {
                async getInfo() {
                    try {
                        let response = await axios.get(this.url);
                        if (response.status === 200 && (typeof response.data) === "object") {
                            this.categories = response.data.categories || [];
                            this.lastId = response.data.lastId || 0;
                        }
                    } catch (error) {
                    }
                },
                async sendCategories() {
                    try {
                        let response = await axios.post(this.url, {
                            categories: this.categories,
                            lastId: this.lastId
                        });
                        if (response.status === 200) {
                            location.reload();
                        }
                    } catch (error) {
                    }
                },
                addCategory() {
                    this.lastId++;
                    let newCat = {
                        id: this.lastId,
                        title: ''
                    };
                    this.categories.push(newCat);
                },
                removeCategory(id) {
                    if (this.categories.length) {
                        let index = this.categories.findIndex(cat => cat.id === id);
                        if (index !== -1) {
                            this.categories.splice(index, 1);
                        }
                        index = -1;
                    }
                }
            },
            created() {
                this.getInfo();
            }
        });
    }
})
();