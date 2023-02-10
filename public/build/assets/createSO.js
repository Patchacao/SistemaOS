var clientinfos //variavel que recebe as informaçoes do cliente selecionado
var clientsSearchList //variavel que recebe a lista de clientes que atendem a busca
var itens = {}; //variavel que recebe os dados dos itens cadastrados
var item = {}; //variavel que recebe os dados do item cadastrado
var linked_objects = {}; //variavel que recebe os dados dos objetos relacionados
var object_repairs = {}; //variavel que recebe os dados dos reparos a serem realizados no objeto

// Ajax Jquery create client


$(document).ready(function () {

    $(document).on('click', '.add_client', function (e) {
        e.preventDefault();
    
        
        $(this).text('Sending..');
       
        var data = {
            'phone_number': $("#phone_number").cleanVal(),
            'whatsapp': $('#whatsapp').val(),
            'name': $('#name').val(),
            'last_name': $('#last_name').val(),
            'nickname': $('#nickname').val(),
            'cpf': $('#cpf').val(),
           
        }
    
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
        $.ajax({
            type: "POST",
            url: "/clients/create",
            data: data,
            dataType: "json",
            success: function(data){
             //console.log(data);
             $('span').remove(".error_msg");
             $('#success_message').html(data.message);
             
                clientinfos = {
                id:data.id,
                phone_number: $("#phone_number").val(),
                name:$('#name').val(),
                last_name:$('#last_name').val(),
                };
            
            InsertClientInfo();
                $('#offcanvasCustomer').offcanvas('hide');
                $('#createClientToast').toast("show");
            return clientinfos;
             
        },
        error: function (err) {
            if (err.status == 422) { // when status code is 422, it's a validation issue
                console.log(err.responseJSON);
                
                
                // you can loop through the errors object and show it to the user
                console.warn(err.responseJSON.errors);
                // display errors on each form field
                $('#success_message').html("");
                $('span').remove(".error_msg");
                
                $.each(err.responseJSON.errors, function (i, error) {
                    
                  var el = $(document).find('[name="'+i+'"]');
                    el.after($('<span class="error_msg" id="error_msg" style="color: red;">'+error[0]+'</span>'));
                    
                });
            }
        }
            })
        });
    
    });

// Ajax Jquery Select client
var timer;
$('#searchClient').on('keyup',function(s)
{
    $value=$(this).val();
    clearTimeout(timer);
    var ms = 500; // milliseconds
    timer = setTimeout(function() {
      
   $('tr').remove(".searchReturn");

 $.ajax({
    type: "get",
    url: "/clients/search",
    data: {'search':$value},
    dataType: "json",
    success: function (response){

        console.log(response);
        
        $('#searchContent').html("");
        $(".searchRow").remove();
        
       if ($.trim(response) == '' ) {
        clientsSearchList = "";
        $('#noClientFound').html('Nenhum cliente com esse nome');
        $('#createClienteBtn').show();
          
       } else {
        
        clientsSearchList = response;
        $('#noClientFound').html("");
        $('#createClienteBtn').hide();
        
        $(response).each(function(index, element) {
            
         $('#searchContent').append(
            '<tr class="searchRow">\
            <td>' + element.name + '</td>\
            <td>' + element.last_name + '</td>\
            <td><button type="button" value="' + element.id + '" class="btn btn-primary SelectClientBtn btn-sm" data-bs-dismiss="offcanvas">Edit</button></td>\
          </tr>');
          });
        }
    }
     });
    }, ms);
})

$(document).on('click', '.SelectClientBtn', function () {

    var searchId = $(this).val();
    
   //console.log(searchId);

      clientinfos = clientsSearchList.find(element => element.id == searchId);
      
        console.log(clientinfos); 
      console.log(clientsSearchList);
      InsertClientInfo();
      
})

// Jquery Create client

// Mascara de Celular

$(document).ready(function(){
        
    $('#phone_number').mask('(00) 0000-00009');
    
    $('#phone_number').keyup(function(){
        
        var phone = $('#phone_number').cleanVal();
        var phoneLength = phone.length;
       
        if (phoneLength>10) {
            $('#phone_number').mask('(00) 00000-0000');
            
        } else{
            $('#phone_number').mask('(00) 0000-00009');
        }
    });
})

//Funçao que coloca o texto do input em caixa alta

 function toUpperCase(a) {
    a.value = a.value.toUpperCase()
}

// Função que verifica se o numero do telefone já está cadastrado

$('#phone_number').on('focusout',function(s)
{
   $value=$(this).cleanVal();
  var valueLenght=$value;
  
  //console.log(valueLenght.length);
  
  if (valueLenght.length>9) {
   
$.ajax({
    type: "get",
    url: "/clients/phone-verification",
    data: {'search':$value},
    dataType: "json",
    success: function (response){

        console.log(response);
        
        
       if ($.trim(response) == '' ) {
        alert("teste");
       } else {
        
        $(response).each(function(index, element) {

                $('#whatsapp').val(element.whatsapp);
                $('#name').val(element.name);
                $('#last_name').val(element.last_name);
                $('#nickname').val(element.nickname);
                $('#cpf').val(element.cpf);
        });
        }
    }
    });
}
})

// Função que insere os as informaçoes do cliente na OS
                
function InsertClientInfo () {

    //console.log(clientinfos);
    $('#nameInput').val(clientinfos.name);
    $('#last-nameInput').val(clientinfos.last_name);
    $('#phone-numberInput').val(clientinfos.phone_number);
    $('#searchOSI').focus();

}

// Função que lida com o escaneamento dos codigos OS

$('#searchOSi').on('keypress',function(e)
{
   $value=$(this).val();
  
  
  if(e.which == 13) {
  
    if ($value != '') {
   
        $.ajax({
            type: "get",
            url: "/service-order/create/searchos",
            data: {'search':$value},
            dataType: "json",
            success: function (response){

            if ($.trim(response) == '' ) {
            
            } else {
                
                }
    }
    });
}
}
})

// Função que lida com o escaneamento do codigo da OS

$('#searchOS').on('keypress',function(e) {
    
    $value=$(this).val();
    
    if(e.which == 13) {

        if (checkScan($value) == 'notFound') {
        $('#searchOS').prop('disabled', true);   
        $('#offcanvasSelectCustomer').offcanvas('show');
        $('#searchOSI').prop('disabled', false);
        $('#searchClient').focus();

        } else {
            alert("Esse código já esta em uso. Por favor, escolha outro!");
        }
    }  
});

// Função que lida com o escaneamento do codigo do Objeto

$('#searchOSI').on('keypress',function(e) {
    
    $value=$(this).val();
    
    if(e.which == 13) {

        if (checkScan($value) == 'notFound' && $value != $('#searchOS').val() ) {
            
        $('#offcanvasSelectItem').offcanvas('show');
        $('#searchOSI').prop('disabled', true);
       
        } else {
            alert("Esse código já esta em uso. Por favor, escolha outro!");
            $('#searchOSI').val('');
        }
    }  
});


function checkScanOS(r) {

    let retOS = ""
    $value= r;
    if ($value != '') {
        
            $.ajax({
                type: "get",
                url: "/service-order/create/searchos",
                data: {'search':$value},
                dataType: "json",
                async: false,
                success: function (response){
            
                    retOS = ($.trim(response));
                }
        });
    
    return retOS;
  }
    
}

function checkScanOSI(r) {
    
    let retOSI;
    $value= r;
    if ($value != '') {
        
            $.ajax({
                type: "get",
                url: "/service-order/create/searchobject",
                data: {'search':$value},
                dataType: "json",
                async: false,
                success: function (response){
            
                    retOSI = ($.trim(response));
                }
        });
    
    return retOSI;
  }
    
}

function checkScan(r) {

   $checkResult = '';
   
   if (checkScanOS(r) =='') {

        if (checkScanOSI(r) =='') {
            
            $checkResult = 'notFound';

        } else {
           $checkResult = 'Found';
        }
        
    } else{
       
        $checkResult = 'Found';
    }
    
    return $checkResult;
}

// Função que busca e constroi a lista de itens no offcanvas

$( document ).ready(function() {
    
$.ajax({
    type: "get",
    url: "/service-order/create/listItems",
    //data: {'search':$value},
    dataType: "json",
    success: function (response){

        console.log(response);
        
        $(response).each(function(index, element) {
            
         $('#itens_list').append(
            '<div class=" itemCard card-inner p-4 mb-1 d-flex flex-column align-items-center"\
             value ="teste" data-bs-toggle="offcanvas"\
             data-bs-target="#offcanvasObjects">\
             <div class="text-center mg-text"> <span class="itemName" style="font-size: 17px">'+element.item+'</span> </div>\
            </div>');
          });
        }
    });
})

$(document).on('click', '.itemCard', function () {

    var selectedItem = $(this).text().trim();
    
    //itens.push(selectedItem);

   console.log(selectedItem);
   //console.log(itens);

      
      
})