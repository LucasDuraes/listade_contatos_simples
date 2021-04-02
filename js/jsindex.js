function validar_dados(){
    var nome = document.getElementById('nome').value
    var telefone = document.getElementById('telefone').value
    var email = document.getElementById('email').value
    
    if (nome==""){
        alert('Prencha o campo nome!')
        document.getElementById('nome').focus()
        return false
    }
    
    if (telefone==""){
        alert('Prencha o campo Telefone!')
        document.getElementById('telefone').focus()
        return false
    }
    
    if (email==""){
        alert('Prencha o campo E-mail!')
        document.getElementById('email').focus()
        return false
    } 
}