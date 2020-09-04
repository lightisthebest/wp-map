<div id="my-map">
    <ul class="nav nav-tabs">
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
    <select v-model="category" @change="getInfo" style="width: 25em;  margin-top: 2rem;">
        <option value=""></option>
        <option v-for="cat in categories" :value="cat.id">{{ cat.title }}</option>
    </select>
    <div class="google-map" v-for="tab in tabs" v-show="tab.active" :id="'google-map-' + tab.id"></div>
</div>
