<h1>Категорії</h1>
<div id="map-categories">
    <div v-for="cat in categories">
        <table class="form-table" role="presentation" style="max-width: 1000px">
            <tbody>
            <tr>
                <th scope="row"><label :for="'category-'+cat.id">Назва
                        категорії</label></th>
                <td>
                    <div>
                        <input
                                type="text"
                                :id="'category-'+cat.id"
                                v-model="cat.title"
                                class="regular-text"
                                placeholder="Нова категорія"
                        >
                        <button class="btn btn-danger my-map-remove-btn" @click="removeCategory(cat.id)">
                            Видалити
                        </button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
        <hr>
    </div>
    <button class="btn btn-success my-map-add-btn" @click="addCategory">Додати</button>

    <p class="submit">
        <input type="button" class="btn btn-success" @click="sendCategories" value="Зберегти зміни"/>
    </p>
</div>