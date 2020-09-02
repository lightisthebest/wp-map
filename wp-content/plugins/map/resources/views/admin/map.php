<h1>Загальні налаштування</h1>
<div id="map-vue">
	<form method="POST">
		<table class="form-table" role="presentation">
			<tbody>
			<tr>
				<th scope="row"><label for="key">API ключ</label></th>
				<td><input name="key" type="text" id="key" v-model="key" class="regular-text"></td>
			</tr>

			<tr>
				<th scope="row"><label for="lat">Широта</label></th>
				<td><input name="lat" type="number" id="lat" v-model="lat" class="regular-text"></td>
			</tr>

			<tr>
				<th scope="row"><label for="lng">Довгота</label></th>
				<td><input name="lng" type="number" id="lng"  v-model="lng" class="regular-text"></td>
			</tr>


			<tr>
				<th scope="row"><label for="zoom">Zoom</label></th>
				<td><input name="zoom" type="number" id="zoom"  v-model="zoom" class="regular-text"></td>
			</tr>

			<tr>
				<th scope="row"><label for="styles">Стилі карти</label></th>
				<td><input name="styles" type="text" id="styles" v-model="styles" class="regular-text"></td>
			</tr>
			</tbody>
		</table>
		<p class="submit">
			<input type="submit" class="button-primary" value="Зберегти зміни"/>
		</p>
	</form>
</div>