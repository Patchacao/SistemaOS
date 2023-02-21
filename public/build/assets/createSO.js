var clientinfos //variavel que recebe as informaçoes do cliente selecionado
var clientsSearchList //variavel que recebe a lista de clientes que atendem a busca
var itens = {}; //variavel que recebe os dados dos itens cadastrados
var item = {}; //variavel que recebe os dados do item cadastrado
var selectedItem; // variavel que receve os dados do item selecionado durante o cadastro
var linked_objects = []; //variavel que recebe os dados dos objetos relacionados
var object_repairs = {}; //variavel que recebe os dados dos reparos a serem realizados no objeto
const ScannedObjectNumbers = []; // variavel que recebe os codigos de objetos que foram escaneados

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
      
        //console.log(clientinfos); 
      //console.log(clientsSearchList);
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
        ScannedObjectNumbers.push($value);
        console.log(ScannedObjectNumbers);

        } else {
            alert("Esse código já esta em uso. Por favor, escolha outro!");
        }
    }  
});

// Função que lida com o escaneamento do codigo do Objeto

$('#searchOSI').on('keypress',function(e) {
    
    $value=$(this).val();
    
    if(e.which == 13) {

        if (checkScan($value) == 'notFound') {
            
        $('#offcanvasSelectItem').offcanvas('show');
        $('#searchOSI').prop('disabled', true);
        ScannedObjectNumbers.push($value);
        console.log(ScannedObjectNumbers);  
       
        } else {
            alert("Esse código já esta em uso. Por favor, escolha outro!");
            $('#searchOSI').val('');
        }
    }  
});


// Função que lida com o escaneamento do codigo do Objeto Relacionado

$('#searchLinkedObjectNumber').on('keypress',function(e) {
    
    $value=$(this).val();
    
    if(e.which == 13) {

        if (checkScan($value) == 'notFound') {
            
            $('#LinkableObjectsList').prop('hidden', false);
            $('#searchLinkedObjectNumber').prop('disabled', true);
            $('#LinkableObjectsList').focus(); 
            $('#addLinkedObject').prop('hidden', false);
            
            ScannedObjectNumbers.push($value);
        
        } else {
            alert("Esse código já esta em uso. Por favor, escolha outro!");
            $('#searchLinkedObjectNumber').val('');
        }
    }  
});

function checkObjectNumberScan(r) {

    let ObjectNumberScan = ""
    $value= r;
    if ($value != '') {
        
            $.ajax({
                type: "get",
                url: "/service-order/create/checkObjectNumber",
                data: {'search':$value},
                dataType: "json",
                async: false,
                success: function (response){
            
                    ObjectNumberScan = ($.trim(response));
                }
        });
    
    return ObjectNumberScan;
  }
    
}

function checkScan(r) { //Funçao que verifica se já o codigo escaneado ja está cadastrado no banco

   $checkResult = '';
   
   if (jQuery.inArray(r, ScannedObjectNumbers) == '-1') {

    if (checkObjectNumberScan(r) =='') {

        $checkResult = 'notFound';

        } else {
           $checkResult = 'Found';
        }
    
   } else {
    
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
             value ='+element.id+' data-bs-toggle="offcanvas"\
             data-bs-target="#offcanvasObjects">\
             <div class="text-center mg-text"> <span class="itemName" style="font-size: 17px">'+element.item+'</span> </div>\
            </div>');
          });
        }
    });
})

$(document).on('click', '.itemCard', function () { // joga as informaçoes do item selecionado para o objeto

    selectedItem = "";
     selectedItem = {
        'item' :$(this).text().trim(),
        'id' : $(this).attr("value"),
    };
    
    LoadLinkableObjects();
  
})


function LoadLinkableObjects(s) //Carrega os objetos relacionaveis
{
    $value=selectedItem.id;
    
 $.ajax({
    type: "get",
    url: "/service-order/create/LoadLinkableObjects",
    data: {'search':$value},
    dataType: "json",
    success: function (response){
    
        $('#LinkableObjectsList').html("<option value='0' selected>Selecione o Objeto</option>");
        
        $(response).each(function(index, element) {
            
         $('#LinkableObjectsList').append(
           '<option value="'+ element.id +'">'+ element.linkable_object +'</option>'
            );
            console.log(element.id);
          });
        }
    });
}

$('#addLinkedObject').on('click',function(e) { // Funçao que adiciona o objeto escolhido ao array
    
    if ($('#LinkableObjectsList').val() != "0" && $('#searchLinkedObjectNumber').val() !='') {
        
        $selectedLinkedObject = {
            
            'item' : $('#LinkableObjectsList').find(":selected").text(),
            'id' : $('#LinkableObjectsList').find(":selected").val(),
        };
        
        $('#addLinkedObject').prop('hidden', true);
        $('#LinkableObjectsList').prop('hidden', true);
        $('#LinkableObjectsList').val("0");
        $('#searchLinkedObjectNumber').prop('disabled', false); 
        $('#searchLinkedObjectNumber').focus(); 
        $('#searchLinkedObjectNumber').val(""); 
        
        linked_objects.push( $selectedLinkedObject);
        LoadLinkedObjectTable()
        
        console.log(linked_objects);
    } else {
        
        alert("Selecione o Objeto");
    }
   
});

function LoadLinkedObjectTable(){
    
    $('#LinkedObjectTable').html("");
    
    $(linked_objects).each(function(index, element) {
            
        $('#LinkedObjectTable').append(
           '<tr class="LinkedObjectRow">\
           <td>' + element.id + '</td>\
           <td>' + element.item + '</td>\
           <td><button type="button" value="' + element.id + '" class="btn btn-primary LinkedObjectRowBtn btn-sm">Edit</button></td>\
         </tr>');
         });
}