aux = window.location.pathname.split('/');
objectCode = aux[2];

function mostraModal() {
    /***************----- 
    
        return fetch(`/email/send/${email}?code=${objectCode}`)
        .then(response => {
            if (response.error) {
                console.log(result)
                alert('ERRO 1', result.msg)
            throw new Error(response.statusText)
            }
            return response.json()
        })
        .catch(error => {
            console.log(error.msg)
            Swal.showValidationMessage(
            `Request failed: ${error.msg}`
            )
        })
    },
    *************----- */


    /***************----- 
        if(result.value.error) {
            
            msgError = result.value.error_list["#email"];
            console.log(msgError);
            
            Swal.showValidationMessage(
                `Request failed: ${msgError}`
                )
        }else {
            Swal.fire(
                'Uhuu!',
                'Email enviado com Sucesso!',
                'success'
              )
        }
    ***************----- */
            
       

        /*Swal.fire({
        title: `${result.value.email}'s avatar`,
        imageUrl: result.value.avatar_url
        })
    }
    })*/
}