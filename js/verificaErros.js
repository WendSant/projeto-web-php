

let query = location.search.slice(1);
let divErro = document.querySelector('#divErro');
let divLogout = document.querySelector('#divLogout');
let partes = query.split('&');
let data = {};
partes.forEach(function (parte) {
    let chaveValor = parte.split('=');
    let chave = chaveValor[0];
    let valor = chaveValor[1];
    data[chave] = valor;
});
const verificarObjetoVazio = (obj) => {
    return JSON.stringify(obj) === "{}";
};

console.log(data);

if(!verificarObjetoVazio(data)){
    if(data.erro == 1){
        divErro.innerHTML = "Email e/ou senha inválidos!"
        divErro.style.display = "block";
    }else if(data.erro == 2){
        divErro.innerHTML = "Faça login no sistema!"
        divErro.style.display = "block";
    }else if(data.logout == 1){
        divLogout.style.display = "block";
        divLogout.innerHTML = "Desconectado com sucesso!"
    }else if(data.fieldErro == "nome"){
        divErro.innerHTML = "Preencha corretamente o campo de nome!"
        divErro.style.display = "block";
    }else if(data.fieldErro == "email"){
        divErro.innerHTML = "Preencha corretamente o campo de e-mail!"
        divErro.style.display = "block";
    }else if(data.fieldErro == "senha"){
        divErro.innerHTML = "A senha deve ter no minimo 8 caracteres"
        divErro.style.display = "block";
    }else if(data.fieldErro == "senhaNotEquals"){
        divErro.innerHTML = "As senhas devem ser iguais!"
        divErro.style.display = "block";
    }else if(data.success == "registerUser"){
        divLogout.innerHTML = "Usuario cadastrado com sucesso!"
        divLogout.style.display = "block";
    }else if(data.error == "interno"){
        divErro.innerHTML = "Erro interno do servidor, contate um administrador!"
        divErro.style.display = "block";
    }else if(data.fieldErro == "nomePaciente"){
        divErro.innerHTML = "Preencha corretamente o campo de nome!";
        divErro.style.display = "block";
    }else if(data.fieldErro == "pesoPaciente"){
        divErro.innerHTML = "Preencha corretamente o campo de peso!";
        divErro.style.display = "block";
    }else if(data.fieldErro == "alturaPaciente"){
        divErro.innerHTML = "Preencha corretamente o campo de altura!";
        divErro.style.display = "block";
    }else if(data.fieldErro == "idadePaciente"){
        divErro.innerHTML = "Preencha corretamente o campo de idade!";
        divErro.style.display = "block";
    }else if(data.success == "registerPaciente"){
        divLogout.innerHTML = "Paciente Cadastrado com sucesso!"
        divLogout.style.display = "block";
    }else if(data.success == "deletedPaciente"){
        divLogout.innerHTML = "Paciente deletado com sucesso!"
        divLogout.style.display = "block";
    }else if(data.erro == "internoDelete"){
        divErro.innerHTML = "Erro interno no servidor";
        divErro.style.display = "block";
    }
}
