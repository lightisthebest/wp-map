<div id="my-map">
    <ul class="nav nav-tabs" style="width: 100%">
        <li v-for="tab in tabs"
            class="nav-item"
        >
            <div class="nav-link my-map-test"
                 :class="{'active': tab.active}"
            >
                <div class="my-map-tab-text"
                     @click="makeActive(tab.id)"
                >
                    {{ tab.tabTitle }}
                </div>
            </div>
        </li>
    </ul>
    <div class="google-map" v-for="tab in tabs" v-show="tab.active" :id="'google-map-' + tab.id"></div>
</div>
