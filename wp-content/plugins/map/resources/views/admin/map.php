<h1>Загальні налаштування</h1>
<div id="map-vue">
    <table class="form-table" role="presentation">
        <tbody>
        <tr>
            <th scope="row"><label for="key">API ключ</label></th>
            <td><input name="key" type="text" id="key" v-model="map.key" class="regular-text"></td>
        </tr>

        <tr>
            <th scope="row"><label for="lat">Широта</label></th>
            <td><input name="lat" type="text" id="lat" v-model="map.lat" class="regular-text"></td>
        </tr>

        <tr>
            <th scope="row"><label for="lng">Довгота</label></th>
            <td><input name="lng" type="text" id="lng" v-model="map.lng" class="regular-text"></td>
        </tr>


        <tr>
            <th scope="row"><label for="zoom">Zoom</label></th>
            <td><input name="zoom" type="number" min="0" max="18" id="zoom" v-model="map.zoom" class="regular-text"></td>
        </tr>

        <tr>
            <th scope="row"><label for="styles">Стилі карти</label></th>
            <td><input name="styles" type="text" id="styles" v-model="map.styles" class="regular-text"></td>
        </tr>
        </tbody>
    </table>
    <p class="submit">
        <input type="button" class="btn btn-success" @click="sendMap" value="Зберегти зміни"/>
    </p>
</div>