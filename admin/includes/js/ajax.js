


// PRODUTOS
function todosProdutos() {


  $.ajax({
    url: "./view/adminProdutos.php",
    method: "post",
    data: { record: 1 },
    success: function (data) {
      $(".todos-conteudos").html(data);
    },
  });
}

function detalhesProdutos(id) {
  $.ajax({
    url: "./view/detalhesProduto.php",
    method: "post",
    data: { record: id },
    success: function (data) {
      $(".todos-conteudos").html(data);
    },
  });
}

function addProduto() {
  var nome = $("#nome").val();
  var descricao = $("#descricao").val();
  var preco = $("#preco").val();
  var categoria = $("#categoria").val();
  var quantidade = $("#quantidade").val();
  var submit = $("#submit").val();
  var imagem = $("#imagem")[0].files[0];

  var fd = new FormData();
  fd.append("nome", nome);
  fd.append("descricao", descricao);
  fd.append("preco", preco);
  fd.append("categoria", categoria);
  fd.append("quantidade", quantidade);
  fd.append("imagem", imagem);
  fd.append("submit", submit);
  $.ajax({
    url: "./acoes/produto/guardarBD.php",
    method: "post",
    data: fd,
    processData: false,
    contentType: false,
    success: function (data) {
      $("form").trigger("reset");
      todosProdutos();
      alert("Produto Adicionado com sucesso");
    },
  });
}

function deleteProduto(id) {
  // TODO: colocar um confirmaçao
  var ask = confirm("Desejas mesmo remover o produto?");
  
  if(ask) { 
    $.ajax({
      url: "./acoes/produto/deleteBD.php",
      method: "post",
      data: { record: id },
      success: function (data) {
        $("form").trigger("reset");
        todosProdutos();
        alert("Produto deletado com sucesso");
      },
    });
  }

}

// carregar formulario de edição do produto
function editarProdutoForm(id) {
  $.ajax({
    url: "./view/editarProduto.php",
    method: "post",
    data: { record: id },
    success: function (data) {
      $(".todos-conteudos").html(data);
    },
  });
}

// atualizar o produto na BD
function atualizarProduto() {
  var codigo = $("#codigo").val();
  var nome = $("#nome").val();
  var descricao = $("#descricao").val();
  var preco = $("#preco").val();
  var categoria = $("#categoria").val();
  var quantidade = $("#quantidade").val();
  var submit = $("#submit").val();
  var imagem = $("#imagem").val();
  var novaImagem = $("#novaImagem")[0].files[0];

  var fd = new FormData();
  fd.append("codigo", codigo);
  fd.append("nome", nome);
  fd.append("descricao", descricao);
  fd.append("preco", preco);
  fd.append("categoria", categoria);
  fd.append("quantidade", quantidade);
  fd.append("imagem", imagem);
  fd.append("novaImagem", novaImagem);
  fd.append("submit", submit);
  $.ajax({
    url: "./acoes/produto/editarBD.php",
    method: "post",
    data: fd,
    processData: false,
    contentType: false,
    success: function (data) {
      $("form").trigger("reset");
      todosProdutos();
      alert("Produto atualizado com sucesso");
    },
  });
}

//======= UTILIZADORES =========
function todosUtilizadores() {


  $.ajax({
    url: "./view/adminUtilizadores.php",
    method: "post",
    data: { record: 1 },
    success: function (data) {
      $(".todos-conteudos").html(data);
    },
  });
}

function addUtilizador() {
  var nome = $("#nome").val();
  var telefone = $("#telefone").val();
  var nif = $("#nif").val();
  var tpUtilizador = $("#tpUtilizador").val();
  var morada = $("#morada").val();
  var username = $("#username").val();
  var password = $("#password").val();
  var submit = $("#submit").val();
  var foto = $("#foto")[0].files[0];

  var fd = new FormData();
  fd.append("nome", nome);
  fd.append("telefone", telefone);
  fd.append("nif", nif);
  fd.append("tpUtilizador", tpUtilizador);
  fd.append("morada", morada);
  fd.append("username", username);
  fd.append("password", password);
  fd.append("foto", foto);
  fd.append("submit", submit);
  $.ajax({
    url: "./acoes/utilizador/guardarBD.php",
    method: "post",
    data: fd,
    processData: false,
    contentType: false,
    success: function (data) {
      $("form").trigger("reset");
      todosUtilizadores();
      alert("Utilizador Adicionado com sucesso");
    },
  });
}

//TODO
function deleteUtilizador(id) {
  // TODO: colocar um confirmaçao
  var ask = confirm("Desejas mesmo remover o utilizador?")

  if(ask) {
    $.ajax({
      url: "./acoes/utilizador/deleteBD.php",
      method: "post",
      data: { record: id },
      success: function (data) {
        $("form").trigger("reset");
        todosUtilizadores();
        // alert("Utilizador deletado com sucesso");
      },
    });
  }

}

function editarUtilizadorForm(id) {
  $.ajax({
    url: "./view/editarUtilizador.php",
    method: "post",
    data: { record: id },
    success: function (data) {
      $(".todos-conteudos").html(data);
    },
  });
}

// atualizar o utilizador na BD
function atualizarUtilizador() {
  var codigo = $("#codigo").val();
  var nome = $("#nome").val();
  var telefone = $("#telefone").val();
  var morada = $("#morada").val();
  var username = $("#username").val();
  var pass = $("#pass").val();
  var tpUtilizador = $("#tpUtilizador").val();
  var submit = $("#submit").val();
  var foto = $("#foto").val();
  var novaFoto = $("#novaFoto")[0].files[0];

  var fd = new FormData();
  fd.append("codigo", codigo);
  fd.append("nome", nome);
  fd.append("telefone", telefone);
  fd.append("morada", morada);
  fd.append("username", username);
  fd.append("pass", pass);
  fd.append("tpUtilizador", tpUtilizador);
  fd.append("foto", foto);
  fd.append("novaFoto", novaFoto);
  fd.append("submit", submit);
  $.ajax({
    url: "./acoes/utilizador/editarBD.php",
    method: "post",
    data: fd,
    processData: false,
    contentType: false,
    success: function (data) {
      $("form").trigger("reset");
      todosUtilizadores();
      alert("Utilizador atualizado com sucesso");
    },
  });
}

function detalhesUtilizador(id) {
  $.ajax({
    url: "./view/detalhesUtilizadores.php",
    method: "post",
    data: { record: id },
    success: function (data) {
      $(".todos-conteudos").html(data);
    },
  });
}

// ====== CLIENTES =======
function todosClientes() {
  $.ajax({
    url: "./view/adminCliente.php",
    method: "post",
    data: { record: 1 },
    success: function (data) {
      $(".todos-conteudos").html(data);
    },
  });
}

function detalhesCliente(id) {
  $.ajax({
    url: "./view/detalhesCliente.php",
    method: "post",
    data: { record: id },
    success: function (data) {
      $(".todos-conteudos").html(data);
    },
  });
}

function deleteCliente(id) {
  // TODO: colocar um confirmaçao

    $.ajax({
      url: "./acoes/cliente/deleteBD.php",
      method: "post",
      data: { record: id },
      success: function (data) {
        $("form").trigger("reset");
        todosClientes();
        alert("Cliente deletado com sucesso");
      },
    });

  
}

function editarClienteForm(id) {
  $.ajax({
    url: "./view/editarCliente.php",
    method: "post",
    data: { record: id },
    success: function (data) {
      $(".todos-conteudos").html(data);
    },
  });
}

// atualizar o cliente na BD
function atualizarCliente() {
  var codigo = $("#codigo").val();
  var nome = $("#nome").val();
  var telefone = $("#telefone").val();
  var localidade = $("#localidade").val();
  var ilha = $("#ilha").val();
  var username = $("#username").val();
  var pass = $("#pass").val();
  var submit = $("#submit").val();
  var foto = $("#foto").val();
  var novaFoto = $("#novaFoto")[0].files[0];

  var fd = new FormData();
  fd.append("codigo", codigo);
  fd.append("nome", nome);
  fd.append("email", email);
  fd.append("telefone", telefone);
  fd.append("localidade", localidade);
  fd.append("ilha", ilha);
  fd.append("username", username);
  fd.append("pass", pass);
  fd.append("foto", foto);
  fd.append("novaFoto", novaFoto);
  fd.append("submit", submit);
  $.ajax({
    url: "./acoes/cliente/editarBD.php",
    method: "post",
    data: fd,
    processData: false,
    contentType: false,
    success: function (data) {
      $("form").trigger("reset");
      todosClientes();
      alert("Cliente atualizado com sucesso");
    },
  });
}

function addCliente() {
  var nome = $("#nome").val();
  var email = $("#email").val();
  var telefone = $("#telefone").val();
  var localidade = $("#localidade").val();
  var municipio = $("#municipio").val();
  var ilha = $("#ilha").val();
  var username = $("#username").val();
  var pass = $("#pass").val();
  var submit = $("#submit").val();
  var foto = $("#foto")[0].files[0];
  var nif = $("#nif").val();

  var fd = new FormData();
  fd.append("nome", nome);
  fd.append("email", email);
  fd.append("telefone", telefone);
  fd.append("localidade", localidade);
  fd.append("municipio", municipio);
  fd.append("ilha", ilha);
  fd.append("username", username);
  fd.append("pass", pass);
  fd.append("foto", foto);
  fd.append("submit", submit);
  fd.append("nif", nif);
  $.ajax({
    url: "./acoes/cliente/guardarBD.php",
    method: "post",
    data: fd,
    processData: false,
    contentType: false,
    success: function (data) {
      $("form").trigger("reset");
      todosClientes();
      alert("Cliente Adicionado com sucesso");
    },
  });
}



// CATEGORIAS
function todasCategorias() {
  $.ajax({
    url: "./view/adminCategoria.php",
    method: "post",
    data: {record: 1},
    success: function(data) {
      $(".todos-conteudos").html(data);
    }
  });
}

function addCategoria() {
  var nome = $("#nome").val();
  var submit = $("#submit").val();

  var fd = new FormData();
  fd.append("nome", nome);
  fd.append("submit", submit);

  $.ajax({
    url: "./acoes/categoria/guardarBD.php",
    method: "post",
    data: fd,
    processData: false,
    contentType: false,
    success: function (data) {
      $("form").trigger("reset");
      todasCategorias();
    },
  });
}

// TIPOS UTILIZADORES
function tiposUtilizadores() {
  $.ajax({
    url: "./view/adminTipo.php",
    method: "post",
    data: {record: 1},
    success: function(data) {
      $(".todos-conteudos").html(data);
    }
  });
}

function addTipo() {
  var tipo = $("#tipo").val();
  var submit = $("#submit").val();

  var fd = new FormData();
  fd.append("tipo", tipo);
  fd.append("submit", submit);

  $.ajax({
    url: "./acoes/tipo/guardarBD.php",
    method: "post",
    data: fd,
    processData: false,
    contentType: false,
    success: function (data) {
      $("form").trigger("reset");
      tiposUtilizadores();
    },
  });
}


// ENCOMENDAS
function todasEncomendas() {
  $.ajax({
    url: "./view/adminEncomenda.php",
    method: "post",
    data: {record: 1},
    success: function(data) {
      $(".todos-conteudos").html(data);
    }
  });
}

function detalhesEncomenda(id) {
  $.ajax({
    url: "./view/detalhesEncomenda.php",
    method: "post",
    data: {id_encomenda: id},
    success: function(data) {
      $(".todos-conteudos").html(data);
    }
  });
}

function marcarEntregue(id) {
  var fd = new FormData();
  fd.append("id_encomenda",id);
  fd.append("acao","marcar_encomenda");

  $.ajax({
    url: "./acoes/encomenda/editarBD.php",
    method: "post",
    data: fd,
    processData: false,
    contentType: false,
    success: function (data) {
      $("form").trigger("reset");
      todasEncomendas();
    },
  });
}


// PROMOÇÕES
function todasPromocoes() {
  $.ajax({
    url: "./view/adminPromocao.php",
    method: "post",
    data: {record: 1},
    success: function(data) {
      $(".todos-conteudos").html(data);
    }
  });
}

function addPromocao() {
  var produto = $("#produto").val();
  var desconto = $("#desconto").val();
  var data_ini = $("#data_ini").val();
  var data_fim = $("#data_fim").val();

  console.log(typeof(data_ini));
  

  var promo = new FormData();

  promo.append("produto", produto);
  promo.append("desconto", desconto);
  promo.append("data_ini", data_ini);
  promo.append("data_fim", data_fim);
  promo.append("acao", "adicionar");

  $.ajax({
    url: "./acoes/promocao/guardarBD.php",
    method: "post",
    data: promo,
    processData: false,
    contentType: false,
    success: function (data) {
      console.log(data);
      document.querySelector('.modal-backdrop').remove();
      $("form").trigger("reset");
      todasPromocoes();
    },
  });

}

function editarPromocaoForm(id) {
  $.ajax({
    url: "./view/editarPromocao.php",
    method: "post",
    data: { id_promo: id },
    success: function (data) {
      $(".todos-conteudos").html(data);
    },
  });
}

function atualizarPromocao() {
  var id_promo = $('#codigo').val();
  var desconto = $("#desconto").val();
  var preco = $("#preco").val();
  var data_ini = $("#data_ini").val();
  var data_fim = $("#data_fim").val();

  console.log(typeof(data_ini));
  

  var promo = new FormData();

  promo.append("id_promo", id_promo);
  promo.append("desconto", desconto);
  promo.append("preco", preco);
  promo.append("data_ini", data_ini);
  promo.append("data_fim", data_fim);
  promo.append("acao", "editar");

  $.ajax({
    url: "./acoes/promocao/guardarBD.php",
    method: "post",
    data: promo,
    processData: false,
    contentType: false,
    success: function (data) {
      console.log(data);
      $("form").trigger("reset");
      todasPromocoes();
    },
  });

}

function deletePromocao(id) {
  $.ajax({
    url: "./acoes/promocao/guardarBD.php",
    method: "post",
    data: { id_promo: id, acao: 'remover' },
    success: function (data) {
      $("form").trigger("reset");
      todasPromocoes();
    },
  });
}

