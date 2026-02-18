class UserCuestAntecedente {
    static index(selector, user_id, t_antecedente) {
        $(selector).html(`
            <table id="user_cuest_antecedente_show_${t_antecedente}" style="width:100%">
                <tr>
                    <td class="text-primary text-center" style="padding: 0.3em;font-size:0.5em">
                        Sin registros
                    </td>
                </tr>
            </table>
        `);
        UserCuestAntecedente.show(user_id)
            .then(response => {
                let row;
                if (response.length > 0) {
                    $.each(response, function(indexInArray, valueOfElement) {

                        if (valueOfElement['type'] == t_antecedente) {
                            row += `
                                <tr>
                                    <td>
                                        <div class="card" style="margin-bottom: 0px;">
                                            <div class="card-body" style="font-size:0.7em;padding: 0.3rem;">
                                                ${valueOfElement['description']}
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            `;
                        }
                    });
                }
                $(`#user_cuest_antecedente_show_${t_antecedente}`).html(row);
            })
    }
    static async create(selector, user_id, t_antecedente) {
        if (t_antecedente == "quirurgico" || t_antecedente == "hospitalizacion") {
            $(selector).html(`
                <table style="width:100%">
                    <tr>
                        <td style="width:90%">
                            <textarea class="form-control" placeholder="Escriba un antecedente" name="${t_antecedente}[]" id="${t_antecedente}" style="height: 37px;"></textarea>
                        </td>
                        <td>
                            <button id="${t_antecedente}_store" type="submit" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                        </td>
                    </tr>
                </table>
            `);
            $(`#${t_antecedente}_store`).on("click", function() {
                UserCuestAntecedente.store(user_id, t_antecedente)
                    .then(response => {
                        UserCuestAntecedente.index(`#antecedente_${t_antecedente}_show`, user_id, t_antecedente)
                    })
            });
        } else {
            CatUserAntecedente.getAll()
                .then(response => {
                    $.each(response, function(indexInArray, valueOfElement) {
                        $(`#antecedente_${t_antecedente}`).append(`
                        <div class="form-check">
                            <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="${t_antecedente}[]" id="${t_antecedente}${valueOfElement['id']}" value="${valueOfElement['id']}">
                            ${valueOfElement['description']}
                            </label>
                        </div>
                    `);
                        $(`#${t_antecedente}${valueOfElement['id']}`).on("click", function() {
                            UserCuestAntecedente.store(user_id, t_antecedente)
                        });
                    });
                    return UserCuestAntecedente.show(user_id);
                })
                .then(response => {
                    $.each(response, function(indexInArray, valueOfElement) {
                        $(`input[name='${t_antecedente}[]']`).each(function() {
                            //cada elemento seleccionado
                            if ($(this).val() == valueOfElement['cat_user_antecedente_id'] && valueOfElement['type'] == t_antecedente) {
                                $(this).prop("checked", true)
                            }
                        });
                    });
                });

        } //fin else
    }
    static store(user_id,data) {

        let formdata = new FormData();
        //formdata.append("user_cuest_antecedente", JSON.stringify($(`[name="${t_antecedente}[]"]`).serializeArray()))
        formdata.append("user_id", user_id)
        formdata.append("value", data.value )
        //formdata.append("type", t_antecedente)
        formdata.append("_token", $("#_token").val())
        formdata.append("created_at", timestamps())
        return post(location.origin+"/user_cuest_antecedente/store", formdata)
    }

    static show(user_id) {
        let formdata = new FormData();
        formdata.append("_token", $("#_token").val())
        formdata.append("user_id", user_id)
        return post(location.origin+"/user_cuest_antecedente/show", formdata)
    }

}
