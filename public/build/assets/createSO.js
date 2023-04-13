var clientinfos //variavel que recebe as informaçoes do cliente selecionado
var clientsSearchList //variavel que recebe a lista de clientes que atendem a busca
var itens = []; //variavel que recebe os dados dos itens cadastrados
var item = []; //variavel que recebe os dados do item cadastrado
var selectedItem; // variavel que receve os dados do item selecionado durante o cadastro
var linked_objects = []; //variavel que recebe os dados dos objetos relacionados
var object_repairs = []; //variavel que recebe os dados dos reparos a serem realizados no objeto
var RepairsList //variavel que recebe a lista de reparos disponiveis para o item selecionado
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
        //console.log(ScannedObjectNumbers);
       

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
        item["objectNumber"] = $value;
        
       
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
            
            //ScannedObjectNumbers.push($value);
        
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


// -------------------------------------- Lógica do Modal Create OS ----------------------------------------------------------



$('#btnSaveServices').click( function () {
    
    if (object_repairs.length != 0) {  
    
    AddRepairInfo();
    
    refreshModal();
    
    CleanAllValues();

    } else {
        alert("Selecione pelo menos um reparo antes de salvar.");
    }
})

$('#btnEditServices').click( function () {
    
    if (object_repairs.length != 0) {  
    
        refreshModal()
        
        EditRepairInfo();
        
        } else {
        alert("Selecione pelo menos um reparo antes de salvar.");
    }
})

$('#returnBtn').click( function () {
    
    refreshModal();
})


$(document).on('click', '.itemCard', function () {

    select_item($(this));
    
    showRepairsModal();
})
 

$(document).on('click', '.exitBtn', function () {

    refreshModal();
    CleanAllValues();
})

// Funçao que lida com o click  no botao de editar/adicionar reparos

$(document).on('click', '.btnAddRepair', function () {
    
    showRepairsModal();
    
    $('#btnSaveServices').hide();
    $('#btnEditServices').show();
    
    CleanAllValues();
    
    position_on_array = $(this).val();
   
    LoadSelectedRepairs(position_on_array);
})

function refreshModal() {
    
    $('#itens_list').show(); // Função que mostra a lista de itens
    $('#repairList').hide(); // Função que mostra a lista de reparos
    $('#total_price').val("");
    $('#returnBtn').hide();// esconde o btn voltar
    $('#btnSaveServices').show();
    $('#btnEditServices').hide();
}

function showRepairsModal() {
    
    $('#itens_list').hide(); 
    $('#repairList').show();
    $('#returnBtn').hide();
    $('#btnSaveServices').show();
    $('#btnEditServices').hide();
}
// ------------------------------------------------------------------------------------------------------------------------


// Função que busca e constroi a lista de itens 

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
             value ='+element.id+'\
             href="#repairs">\
             <div class="text-center mg-text"> <span class="itemName" style="font-size: 17px">'+element.item+'</span> </div>\
            </div>');
          });
        }
    });
})



// -------------- Logica Objetos relacinaveis------------------------------------------


var position_on_array; // recebe o indice de posiçao do item no array

$(document).on('click', '.btnAddLinkedObject',function(e) {

    position_on_array = $(this).val() // posiçao no array do item que vai receber os objetos linkados
    var item_id = itens[position_on_array].id_item;
    console.log(item_id);
    LoadLinkableObjects(item_id);
});

//Carrega os objetos relacionaveis

function LoadLinkableObjects(s) 
{
    $value=s; // ID DO ITEM SELECIONADO
    
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
            
          });
        }
    });
}

// Funçao que adiciona o objeto vinculado escolhido ao array

$('#addLinkedObject').on('click',function(e) { 
   
   if ($('#LinkableObjectsList').val() != "0" && $('#searchLinkedObjectNumber').val() !='') {
        $objectNumber = $('#searchLinkedObjectNumber').val();
        $selectedLinkedObject = {
            
            'objectNumber' : $('#searchLinkedObjectNumber').val(),
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
        ScannedObjectNumbers.push($objectNumber);
        LoadLinkedObjectTable()
        
        
    } else {
        alert("Selecione o Objeto");
    }
});

//Função que constroi a lista de objetos linkados selecionados no offcanvas

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

// Função que insere os objetos linkados ao array item

$('#btnSaveLinkedObjects').on('click',function(e) { 

   item = itens[position_on_array];
   item["linked_objects"] = linked_objects;
   itens[position_on_array] = item;
   $('#LinkedObjectTable').html("");
   Constructor_CollapseLinkedObjects (linked_objects, position_on_array);

    linked_objects = [];
    item = [];
    position_on_array = "";
})


// ----------------------- Lógica Seleçao de Itens e Serviços -----------------------
 
// Função que zera todas as variaveis e arrays

function CleanAllValues() {
    
    linked_objects = [];
    object_repairs = [];
    item = [];
    position_on_array = "";
    selectedItem = {};
    //RepairsList = [];
    selectedRepairs = {};
}

// joga as informaçoes do item selecionado para o objeto

function select_item(e) { 

    selectedItem = "";
     selectedItem = {
        'item' :$(e).text().trim(),
        'id_item' : $(e).attr("value"),
    };
    
    LoadServices(selectedItem.id_item);
}

//Carrega os serviços para a seleçao

function LoadServices(s) 
{
    $('#RepairContent').html("");
    $value=s;
    RepairsList = [];
 
$.ajax({
    type: "get",
    url: "/service-order/create/LoadServices",
    data: {'search':$value},
    dataType: "json",
    success: function (response){
    
        RepairsList = response;

        LoadRepairsTable(RepairsList);
        LoadSelectedRepairsTable(object_repairs);

       } 
    });
}

// Carrega os itens selecionados na tabela de serviços

function LoadSelectedRepairsTable(selectedRepairs) { 
    
    $(selectedRepairs).each(function(index, element) {
            
        $('#selectedRepair'+ element.id +'').addClass("selectedRepair");
        $('#RepairContent').prepend($('#selectedRepair'+ element.id +''));
        $('#deleteRepairbtn'+ element.id +'').show();
        $('#addRepairbtn'+ element.id +'').hide();
        
      });    
}

function LoadRepairsTable(response) {
    
    
    $(response).each(function(index, element) {
            
        $('#RepairContent').append(
            '<tr class="RepairRow"  id="selectedRepair'+ element.id +'">\
            <td>' + element.service + '</td>\
            <td>' + 'R$' + element.price + '</td>\
            <td><button type="button" value="'+ element.id +'" id="addRepairbtn'+ element.id +'" class="btn btn-primary SelectRepairBtn btn-sm">+</button></td>\
            <td><button type="button" value="'+ element.id +'" id="deleteRepairbtn'+ element.id +'" class="btn btn-danger DeleteRepairBtn btn-sm" style="display: none;">-</button></td>\
          </tr>');
      }); 
}

 // Função que busca os reparos selecionados para o item
    
function LoadSelectedRepairs(e) {
    
    object_repairs = [];

    selectedItem = itens[e];
    object_repairs = selectedItem.repairs;

    LoadServices(selectedItem.id_item);
     
}

// joga as informaçoes do reparo selecionado para o objeto

$(document).on('click', '.SelectRepairBtn', function () { 

    searchId = $(this).attr("value");

    selectedRepair = RepairsList.find(element => element.id == searchId);
     selectedRepair = {
        'service' :selectedRepair.service,
        'id' : selectedRepair.id,
        'price' : parseInt(selectedRepair.price),
    };
    
    object_repairs.push(selectedRepair);

    $(this).hide();
    $('#deleteRepairbtn'+ searchId +'').show();

    LoadSelectedRepairsTable(object_repairs);
    sum_price();
    $('#total_price').val(sum_price());
})

// Funcao que exclui o reparo selecioando da lista

$(document).on('click', '.DeleteRepairBtn', function () { 

    searchId = "";
    searchId = $(this).attr("value");

    selectedRepair = RepairsList.find(element => element.id == searchId);

    object_repairs.splice(selectedRepair,1);
    $('#RepairContent').html("");

    LoadRepairsTable(RepairsList);

    LoadSelectedRepairsTable(object_repairs);

    sum_price();
    
    $('#total_price').val(sum_price());

})

// Funcao que exclui o item e o card

$(document).on('click', '.deleteItembtn', function () { 

    var item_Id = $(this).attr("value");
    
    itens.splice(item_Id,1);

    $($(this).parents('.card')).fadeOut("slow", function(){
        Constructor_ServiceList();
    });

    console.log(itens);
    
})

// Soma do preco dos servicos

function sum_price () {

    var sum = 0; 
    
    for(var i =0;i<object_repairs.length;i++){ 
      sum+=object_repairs[i].price; 
    } 
    
    return sum;
  }

// joga os reparos selecionados no objeto com as informaçoes do item

function AddRepairInfo () {

    item["item"] = selectedItem.item;
    item["id_item"] = selectedItem.id_item;
    item["total_price"] = sum_price ();
    item["repairs"] = object_repairs; // adciona os reparo selecionados ao item
  
    itens.push(item);
    
    Constructor_ServiceList ();

}

// Função que lida com a edição dos reparos selecionados/excluidos

function EditRepairInfo () {

    item = itens[position_on_array];
    item["repairs"] = object_repairs; // adciona os reparo selecionados ao item
    item["total_price"] = sum_price ();
    itens[position_on_array] = item;
   
    console.log(itens[position_on_array]);
    console.log(object_repairs);
    console.log(itens);

    Constructor_CollapseRepairsList (object_repairs,position_on_array);

    CleanAllValues();
    }

function Constructor_ServiceList (){
   
    item = [];
    object_repairs = [];
    linked_objects = [];

    $('#serviceList').html("");  // limpa o html da lista de itens selecionados
    
    
    $(itens).each(function(index, element) { 
            
        item_position = itens.indexOf(element);
        var repairs = element.repairs;
        var lkd_Objects = element.linked_objects; // 

        
        $('#serviceList').append(
            '<div class="card w-90 mb-1">\
            <div class="card-body">\
                <div class="container">\
                    <div class="row">\
                        <div class="col-sm-4">\
                            <input type="search" name="searchOSI" id="searchOSI"\
                            placeholder="Escaneie o código do Objeto" class="form-control me-2 m-auto">\
                        </div>\
                        <div class="col-sm-3">\
                            <p class="card-text"> ' + element.item + '</p>\
                        </div>\
                        <div class="col-sm-2">\
                            <p class="card-text"> R$ 5,90</p>\
                        </div>\
                        <div class="col-sm-1">\
                            <button class="btn btn-primary" type="button" data-bs-toggle="collapse"\
                            data-bs-target="#CollapseRepairs' + item_position+'">\
                            Rep</button>\
                        </div>\
                        <div class="col-sm-1">\
                            <button class="btn btn-primary" type="button" data-bs-toggle="collapse"\
                            data-bs-target="#CollapseLinkedObjects' + item_position+'">\
                            Obj</button>\
                        </div>\
                        <div class="col-sm-1">\
                        <button class="deleteItembtn btn btn-danger" type="button" value ="'+ item_position+'">-</button>\
                        </div>\
                    </div>\
                    <div class="row">\
                        <div class="col">\
                            <div class="collapse multi-collapse show" id="CollapseRepairs' + item_position+'">\
                                <div class="card card-body">\
                                    <table class="table table-hover">\
                                        <div class="row">\
                                            <div class="col-sm-6">\
                                                <h5>Reparos</h5>\
                                            </div>\
                                            <div class="col-sm-1">\
                                                <button type="button" class=" btnAddRepair btn btn-success"\
                                                data-bs-toggle="modal" data-bs-target="#CreateOsiModal"\
                                                    value="'+ item_position +'">+</button>\
                                            </div>\
                                        </div>\
                                        <tbody id="CollapseRepairsList'+ item_position +'"></tbody>\
                                    </table>\
                                </div>\
                            </div>\
                        </div>\
                        <div class="col">\
                            <div class="collapse multi-collapse" id="CollapseLinkedObjects' + item_position+'">\
                                <div class="card card-body" id="CollapseLinkedObjectsList">\
                                    <table class="table table-hover">\
                                        <div class="row">\
                                            <div class="col-sm-6">\
                                                <h5>Objetos Associados</h5>\
                                            </div>\
                                            <div class="col-sm-1">\
                                                <button type="button" class=" btnAddLinkedObject btn btn-success"\
                                                    data-bs-toggle="offcanvas"\ data-bs-target="#offcanvasObjects"\
                                                    value="'+ item_position +'">+</button>\
                                            </div>\
                                        </div>\
                                        <tbody id="CollapseLinkedObjectsList'+ item_position +'"></tbody>\
                                    </table>\
                                </div>\
                            </div>\
                        </div>\
                    </div>\
                </div>\
            </div>');

    Constructor_CollapseRepairsList (repairs,item_position);
    Constructor_CollapseLinkedObjects (lkd_Objects,item_position);
 
});
}

    function Constructor_CollapseRepairsList (repairs,item_position){

        $('#CollapseRepairsList'+ position_on_array +'').html("");

        $(repairs).each(function(index, element) {

            $('#CollapseRepairsList'+ item_position +'').append(
            '<tr>\
                <td>' + element.service + '</td>\
                <td>' + 'R$' + element.price + '</td>\
             </tr>');
        });
    }
    
    function Constructor_CollapseLinkedObjects (lkd_Objects,item_position){

        $(lkd_Objects).each(function(index, element) {
            
            $('#CollapseLinkedObjectsList' + item_position +'').append(
                '<tr>\
                <td>' + element.objectNumber + '</td>\
                <td>' + element.item + '</td>\
                <td><button type="button" value="' + element.id + '" class="btn btn-danger btn-sm">-</button></td>\
              </tr>');
        });
    }

   



            