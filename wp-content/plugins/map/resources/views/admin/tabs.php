<h1>Налаштування вкладок</h1>
<div id="map-tabs">
    <form method="POST">
        <div v-for="tab in tabs" style="margin-bottom: 25px">
            <table class="form-table" role="presentation">
                <tbody>
                <tr>
                    <th scope="row"><label :for="'Tabs[' + tab.id + '][tabTitle]'">Заголовок вкладки</label></th>
                    <td><input :name="'Tabs[' + tab.id + '][tabTitle]'" type="text" :id="'Tabs[' + tab.id + '][tabTitle]'" v-model="tab.tabTitle" class="regular-text"></td>
                </tr>

                </tbody>
            </table>
            <hr>
            <table v-for="place in tab.places" class="form-table" role="presentation">
                <tbody>
                <tr>
                    <th scope="row"><label :for="'Tabs[' + tab.id + '][places][' + place.id + '][placeTitle]'">Назва місця</label></th>
                    <td><input
                                :name="'Tabs[' + tab.id + '][places][' + place.id + '][placeTitle]'"
                                type="text"
                                :id="'Tabs[' + tab.id + '][places][' + place.id + '][placeTitle]'"
                                v-model="place.placeTitle"
                                class="regular-text">
                    </td>
                </tr>

                <tr>
                    <th scope="row"><label :for="'Tabs[' + tab.id + '][places][' + place.id + '][lat]'">Широта</label></th>
                    <td><input
                                :name="'Tabs[' + tab.id + '][places][' + place.id + '][lat]'"
                                type="number"
                                :id="'Tabs[' + tab.id + '][places][' + place.id + '][lat]'"
                                v-model="place.lat"
                                class="regular-text">
                    </td>
                </tr>

                <tr>
                    <th scope="row"><label :for="'Tabs[' + tab.id + '][places][' + place.id + '][lng]'">Довгота</label></th>
                    <td><input
                                :name="'Tabs[' + tab.id + '][places][' + place.id + '][lng]'"
                                type="number"
                                :id="'Tabs[' + tab.id + '][places][' + place.id + '][lng]'"
                                v-model="place.lng"
                                class="regular-text">
                    </td>
                </tr>

                <tr>
                    <th scope="row"><label :for="'Tabs[' + tab.id + '][places][' + place.id + '][contentString]'">Тест підпису</label></th>
                    <td><input
                                :name="'Tabs[' + tab.id + '][places][' + place.id + '][contentString]'"
                                type="text"
                                :id="'Tabs[' + tab.id + '][places][' + place.id + '][contentString]'"
                                v-model="place.contentString"
                                class="regular-text">
                    </td>
                </tr>
                </tbody>
            </table>
            <hr>
        </div>
        <p class="submit">
            <input type="submit" class="button-primary" value="Зберегти зміни"/>
        </p>
    </form>
</div>
