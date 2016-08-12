function Usuario() {}
;

Usuario.getUsuarioPorUsername = function (username, f) {
    $.ajax({
        url: "ScriptsAJAX/getUsuarioPorUsername.php?username=" + username,
        success: function (result) {
            var usuario = JSON.parse(result);
            f(usuario);
        }
    });
}
Usuario.getUsuariosDoGrupo = function (idGrupo, f) {
    $.ajax({
        url: "ScriptsAJAX/getUsuariosDoGrupo.php?idGrupo=" + idGrupo,
        success: function (result) {
            var usuarios = JSON.parse(result);
            for(var i = 0 ; i < usuarios.length; i++){
                usuarios[i] = JSON.parse(usuarios[i]);
            }
            f(usuarios);
        }
    });
}