var swiper = new Swiper(".slide-content", {
  slidesPerView: 3,
  spaceBetween: 25,
  loop: true,
  centerSlide: 'true',
  fade: 'true',
  grabCursor: 'true',
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
    dynamicBullets: true,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },

  breakpoints: {
    0: {
      slidesPerView: 1,
    },
    520: {
      slidesPerView: 2,
    },
    950: {
      slidesPerView: 4,
    },
  },
});

function atualizar_carrinho() {
  $.ajax({
    url: "../controlo/carrinho.php",
    method: "get",
    data: { item: "item" },
    success: function (response) {
      $("#cart-item").html(response);
    }
  });
}

atualizar_carrinho();

function adicionar_carrinho(id) {

  $.ajax({
    url: "../controlo/carrinho.php",
    method: "get",
    data: { id: id, acao: 'add_cart' },
    success: function (data) {
      atualizar_carrinho();
    },
  });
};

function adicionar_carrinho_qtd(id) {

  let qtd = $('#addQtd').val();

  $.ajax({
    url: "../controlo/carrinho.php",
    method: "get",
    data: { id: id, qtd: qtd },
    success: function (data) {
      $('#addQtd').val() = 1;
      atualizar_carrinho();
    },
  });
};

function categoria() {


  $.ajax({
    url: "viewCategoria.php",
    method: "post",
    data: { record: 1 },
    success: function (data) {

    },
  });
}

function carrinho() {


  $.ajax({
    url: "./carrinho.php",
    method: "post",
    data: { record: 1 },
    success: function (data) {
    },
  });
}

function deleteCart(id) {

  $.ajax({
    url: "../controlo/carrinho.php",
    method: "get",
    data: { remover: id },
    success: function (data) {
      carrinho();
      atualizar_carrinho();
    },
  });
}

$(document).ready(function () {

  $('.btn-mais').click(function (e) {
    e.preventDefault();

    var qtd = $(this).closest('.dados-produtos').find('.qtd-cart').val();


    var value = parseInt(qtd)

    value++;
    $(this).closest('.dados-produtos').find('.qtd-cart').val(value);

  });

  $('.btn-menos').click(function (e) {
    e.preventDefault();

    var qtd = $(this).closest('.dados-produtos').find('.qtd-cart').val();


    var value = parseInt(qtd)

    if (value > 1) {
      value--;
      $(this).closest('.dados-produtos').find('.qtd-cart').val(value);
    }


  });

  $(document).on('click', '.atualizarQtd', function () {
    var qtd = $(this).closest('.dados-produtos').find('.qtd-cart').val();
    var preco = $(this).closest('.dados-produtos').find('#preco').val();
    var prod_id = $(this).data('id');

    var preco_total = parseInt(qtd) * parseInt(preco);

    $.ajax({
      url: '../controlo/carrinho.php',
      method: 'POST',
      data: { id: prod_id, qtd: qtd, preco: preco_total, acao: 'atualizar' },
      success: function (response) {
        // $('#myTable').load(location.href + " #myTable");
        window.location = 'carrinho.php';
      }
    });
  })



});

$(document).on('click', '.btn-finalizar', function () {

  

  var local = $('#localidade').val();
  var nome = $('#nome').val();
  var email = $('#email').val();
  var ilha = $('#ilha').val();
  var municipio = $('#municipio').val();
  var card_number = $('#card_number').val();
  var validade = $('#validade').val();
  var cvv = $('#cvv').val();  
  var preco_total = $("#preco_total").val();


  if (
    local === '' || nome === '' || email === '' || ilha === '' || municipio === '' || card_number === '' || validade === '' || cvv === ''
  ) {

    window.location = 'encomenda.php?resultado=indefinido';

  } else {

    var id_cliente = $(this).closest('.dados-encomenda').find('#id').val();
    var i = $('#count_id').val();

    console.log("OK");
    var pagamento = new FormData();

    let data_exp = validade.split('/');
    let mes = data_exp[0];
    let ano = "20"+data_exp[1];

    pagamento.append('card_number', card_number);
    pagamento.append('ano', ano);
    pagamento.append('mes', mes);
    pagamento.append('cvv', cvv);
    pagamento.append('preco_total', preco_total);
    
    $.ajax({
      url: '../controlo/pagamentoClient.php',
      method: 'POST',
      data: pagamento,
      processData: false,
      contentType: false,
      success: function (response) {
        var jsonObject = JSON.parse(response);
        let resultado = jsonObject.resultado;
        let mensagem = jsonObject.mensagem;

        console.log(resultado);
        console.log(mensagem);

        resultado = Number(resultado);

        if(resultado == -2 || resultado == -1 || resultado == 0) {
          window.location = 'encomenda.php?resultado='+resultado;
        } else if(resultado > 0) {
          finalizarEncomenda(id_cliente, i, local, ilha, municipio);
        }
      }
    });
  }


})


function finalizarEncomenda(id_cliente, i, local, ilha, municipio) {
  

    var prod = new FormData();

    var count = 0;

    //dados para inserir na tabela  encomenda_produtos
    while (count < i) {
      var id = '#id_prod_' + count;
      var qtd = '#qtd_' + count;
      var total = '#total_' + count;
      var p = $(id).val();
      var q = $(qtd).val();
      var t = $(total).val();
      var index_id = 'id_' + count;
      var index_qtd = 'qtd_' + count;
      var index_t = 'total_' + count;
      prod.append(index_id, p);
      prod.append(index_qtd, q);
      prod.append(index_t, t);
      count++
    }

    prod.append('id_cliente', id_cliente);
    prod.append('local', local);
    prod.append('ilha', ilha);
    prod.append('municipio', municipio);
    prod.append('count', i);
    prod.append('acao', 'encomenda');

    $.ajax({
      url: '../controlo/encomendaBD.php',
      method: 'POST',
      data: prod,
      processData: false,
      contentType: false,
      success: function (response) {
        window.location = 'pagamento_sucesso.php';
      }
    });
}
