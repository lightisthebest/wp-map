<h1>Налаштування вкладок</h1>
<div id="map-tabs">
    <ul class="nav nav-tabs">
        <li v-for="tab in tabs"
            class="nav-item"
        >
            <div class="nav-link my-map-test"
                 :class="{'active': tab.active}"
            >
                <div class="my-map-close-button"
                     @click="removeTab(tab.id)"

                >
                    <span class="my-map-close-button-text">x</span>
                </div>
                <div class="my-map-tab-text"
                     @click="makeActive(tab.id)"
                >
                    {{ tab.tabTitle }}
                </div>
            </div>
        </li>
        <li v-if="tabs.length < 5" style="display: flex; margin-bottom: 0;">
            <button
                    class="btn btn-success my-map-add-btn"
                    style="padding: 0.3rem"
                    @click="addNewTab"
            >+
            </button>
        </li>
    </ul>


    <div v-for="tab in tabs" v-if="tab.active" style="margin-bottom: 25px">

        <table class="form-table" role="presentation">
            <tbody>
            <tr>
                <th scope="row"><label :for="'Tabs[' + tab.id + '][tabTitle]'">Заголовок вкладки</label></th>
                <td><input :name="'Tabs[' + tab.id + '][tabTitle]'" type="text" :id="'Tabs[' + tab.id + '][tabTitle]'"
                           v-model="tab.tabTitle" class="regular-text"></td>
            </tr>

            </tbody>
        </table>
        <hr>
        <div v-for="place in tab.places">
            <table class="form-table" role="presentation" style="max-width: 1000px">
                <tbody>
                <tr>
                    <th scope="row"><label :for="'Tabs[' + tab.id + '][places][' + place.id + '][placeTitle]'">Назва
                            місця</label></th>
                    <td>
                        <div>
                            <input
                                    :name="'Tabs[' + tab.id + '][places][' + place.id + '][placeTitle]'"
                                    type="text"
                                    :id="'Tabs[' + tab.id + '][places][' + place.id + '][placeTitle]'"
                                    v-model="place.placeTitle"
                                    class="regular-text">
                            <button class="btn btn-danger my-map-remove-btn" @click="removePlace(tab.id, place.id)">
                                Видалити
                            </button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label :for="'Tabs[' + tab.id + '][places][' + place.id + '][category]'">Категорія</label>
                    </th>
                    <td>
                        <select v-model="place.category" style="width: 25em;">
                            <option value=""></option>
                            <option v-for="cat in categories" :value="cat.id">{{ cat.title }}</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <th scope="row"><label :for="'Tabs[' + tab.id + '][places][' + place.id + '][lat]'">Широта</label>
                    </th>
                    <td><input
                                :name="'Tabs[' + tab.id + '][places][' + place.id + '][lat]'"
                                type="text"
                                :id="'Tabs[' + tab.id + '][places][' + place.id + '][lat]'"
                                v-model="place.lat"
                                class="regular-text">
                    </td>
                </tr>

                <tr>
                    <th scope="row"><label :for="'Tabs[' + tab.id + '][places][' + place.id + '][lng]'">Довгота</label>
                    </th>
                    <td><input
                                :name="'Tabs[' + tab.id + '][places][' + place.id + '][lng]'"
                                type="text"
                                :id="'Tabs[' + tab.id + '][places][' + place.id + '][lng]'"
                                v-model="place.lng"
                                class="regular-text">
                    </td>
                </tr>

                <tr>
                    <th scope="row"><label :for="'Tabs[' + tab.id + '][places][' + place.id + '][contentString]'">Текст
                            підпису</label></th>
                    <td class="ckeditor">
                        <ckeditor
                            :editor="editor"
                            v-model="place.contentString"
                            :config="editorConfig"
                            :name="'Tabs[' + tab.id + '][places][' + place.id + '][contentString]'"
                            :id="'Tabs[' + tab.id + '][places][' + place.id + '][contentString]'"
                        ></ckeditor>
                    </td>
                </tr>
                </tbody>
            </table>
            <hr>
        </div>
        <button class="btn btn-success my-map-add-btn" @click="addPlace(tab.id)">Додати</button>
    </div>
    <p class="submit">
        <input type="button" class="btn btn-success" @click="sendTabs" value="Зберегти зміни"/>
    </p>
</div>
