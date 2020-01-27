$(document).ready(function(){
  $("#searchCatalogo").on('click', (e) => {
    e.preventDefault();
    e.stopPropagation();
    const params = {
      code: $('#code').val(),
      description: $('#description').val(),
      clasification: $('#clasification').val(),
      tipo: $('#tipo').val(),
    }
    filter(params);
  })
  $('#productTable').on('click', ' tbody tr', function(e) {
    e.preventDefault();
    e.stopPropagation();
    const id = $(this)[0]['cells'][0].innerText;
    findOne(id);
    getUnidadMedida(id);
    findSonId(id);
    getNutricional(id);
  })
  $('#create-son-product').on('click', (e) => {
    e.preventDefault();
    e.stopPropagation();
    const code = $("#edt-code").val()
    if (code) {
      createSon();
    } else {
      alert("Seleccione una mercancia");
    }
  })
  $('#edt-son-product').on('click', (e) => {
    e.preventDefault();
    e.stopPropagation();
    const code = $("#edt-code").val()
    if (code) {
      update();
    } else {
      alert("Seleccione una mercancia");
    }
  })
  $("#info-nutricional").on('click', (e) => {
    e.preventDefault();
    e.stopPropagation();
    updateNutricional();
  })
  $('#catalogoTable').on('mousedown', 'td button', function (event) {
    let id = $(this).data("id");
    //$(event.target).closest('#catalogoTable tr td'+`#${id}`).prop("contentEditable", true);
      var currentTD = $(this).parents('tr').find('td'+`#${id}`);
      if (currentTD == id) {
          $.each(currentTD, function () {
              $(this).prop('contenteditable', true)
          });
      } else {
         $.each(currentTD, function () {
              $(this).prop('contenteditable', false)
          });
      }

  });

  function filter(params) {
    $.ajax({
      type: 'GET',
      data: params,
      url: '/productos/filter'
    }).then((data) => {
      const html = setProducto(data.data);
      $('#productTable tbody').empty().append(html);
    })
  }
  function setProducto(data) {
    let array = [];
    for (let i = 0; i < data.length; i++) {
      array[i] = `<tr>
                    <td>${data[i].CODI_RCODIGO}</td>
                    <td>${data[i].CODI_RNOMBRE}</td>
                  </tr>`;
    }
    return array;
  }
  async function setCatalogo(data){
    let array = [];
    array[0] = `<tr>
                  <th>Padre</th>
                  <th>Codigo</th>
                  <th>Producto</th>
                  <th>Multipl.</th>
                  <th>Divisor</th>
                  <th>Tipo</th>
                  <th>Estado</th>
                  <th>Usuario</th>
                  <th>Fecha</th>
                  <th>Edit</th>
                </tr>`
    for (let i = 0; i < data.length; i++) {
      let params = await findName(data[i].CODI_RCODIGO);
      if (i >= 1) {
        array[i] = `<tr>

                      <td data-id='${data[i].CODI_RCODIGO}' id='${data[i].CODI_RCODIGO}'>${data[i].CODI_PADRE}</td>
                      <td data-id='${data[i].CODI_RCODIGO}' id='${data[i].CODI_RCODIGO}'>${data[i].CODI_RCODIGO}</td>
                      <td data-id='${data[i].CODI_RCODIGO}' id='${data[i].CODI_RCODIGO}'>${params[0].CODI_RNOMBRE}</td>
                      <td data-id='${data[i].CODI_RCODIGO}' id='${data[i].CODI_RCODIGO}'>${data[i].factor_multi}</td>
                      <td data-id='${data[i].CODI_RCODIGO}' id='${data[i].CODI_RCODIGO}'>${data[i].factor_div}</td>
                      <td data-id='${data[i].CODI_RCODIGO}' id='${data[i].CODI_RCODIGO}'>${data[i].tipo}</td>
                      <td data-id='${data[i].CODI_RCODIGO}' id='${data[i].CODI_RCODIGO}'>${data[i].ESTADO}</td>
                      <td data-id='${data[i].CODI_RCODIGO}' id='${data[i].CODI_RCODIGO}'>${data[i].USUARIO}</td>
                      <td data-id='${data[i].CODI_RCODIGO}' id='${data[i].CODI_RCODIGO}'>${data[i].FECHA_REG}</td>
                      <td data-id='${data[i].CODI_RCODIGO}' id='${data[i].CODI_RCODIGO}'>
                            <button class="btn btn-icon btn-2 btn-primary" type="button" data-id='${data[i].CODI_RCODIGO}' id='${data[i].CODI_RCODIGO}'>
                              <span class="btn-inner--icon"><i class="ni ni-atom"></i></span>
                            </button>
                      </td>

                  </tr>`;
      }



    }
    return array;
  }
  function findName(id) {
     return $.ajax({
          type:'GET',
          url:'/productos/findOne',
          data: {id: id},
      });
  }

  function findOne(id){
    $.ajax({
      type:'GET',
      url:'/productos/findOne',
      data: {id: id}
    }).then((data) => {
      localStorage.setItem('mercancia', JSON.stringify(data[0]));
      getClasificacion();
      getClasificacion2();
      $('#edt-code').val(data[0].CODI_RCODIGO)
      $('#edt-name').val(data[0].CODI_RNOMBRE)
      $('#edt-unid-media').val(data[0].CODI_RCODIGO)
      $('#edt-multi-unid').val(data[0].TUME_MULT)
      $('#edt-tipo-code').val(data[0].TPCO_CODIGO)
      $('#edt-descripcion').val(data[0].CODI_RDESCRIP)
      $('#edt-peso').val(data[0].CODI_PESO)
      $('#edt-afecto-adicional').val(data[0].CODI_RAFECTO5)
      $('#edt-impuesto').val(data[0].IMP_ADICIONAL)
      $('#edt-code-arancelario').val(data[0].codi_arancelario)
      $('#edt-mayorista').val(data[0].prod_mayor)
      $('#edt-state').val(data[0].estado)
    })
  }
  function findSonId(id) {
    $.ajax({
      type:'GET',
      url:'/productos/catalogo',
      data: {id: id}
    }).then((data) => {
      //const html = setCatalogo(data);
       setCatalogo(data).then(function(html) {
          $('#catalogoTable thead').empty().append(html);
      })
    })
  }
  function createSon() {
    let current = JSON.parse(localStorage.getItem('mercancia'));
    const data = {
        CODI_PADRE: current.CODI_PADRE,
        CODI_RCODIGO: $('#create-code').val(),
        CODI_RNOMBRE: $('#create-name').val(),
        TUME_CODIGO: $('#create-unid-media').val(),
        TUME_MULT: $('#create-multi-unid').val(),
        TPCO_CODIGO: $('#create-tipo-code').val(),
        CODI_RDESCRIP: $('#create-descripcion').val(),
        CODI_PESO: $('#create-peso').val(),
        CODI_RAFECTO5: $('#create-afecto-adicional').val(),
        IMP_ADICIONAL: $('#create-impuesto').val(),
        codi_arancelario: $('#create-code-arancelario').val(),
        clco_codigo: $('#create-clasificacion-producto').val(),
        clco_codigo2: $('#create-clasificacion-mercancia').val(),
        prod_mayor: $('#create-mayorista').val(),
        estado: $('#create-state').val(),
        _token: $("meta[name='csrf-token']").attr("content"),

    }
    $.ajax({
      type:'POST',
      url:'/productos/create',
      data: data,
    }).then((data) => {
       alert("creado")
       $('#create-code').val(' ');
       $('#create-name').val(' ');
        $('#create-multi-unid').val(' ');
       $('#create-tipo-code').val(' ');
       $('#create-descripcion').val(' ');
       $('#create-peso').val(' ');
        $('#create-impuesto').val(' ');
       $('#create-code-arancelario').val(' ');
    })
  }
  function update() {
    const data = {
        CODI_RCODIGO: $('#edt-code').val(),
        CODI_RNOMBRE: $('#edt-name').val(),
        TUME_CODIGO: $('#edt-unid-media').val(),
        TUME_MULT: $('#edt-multi-unid').val(),
    //    TPCO_CODIGO: $('#edt-tipo-code').val(),
        CODI_RDESCRIP: $('#edt-descripcion').val(),
        CODI_PESO: $('#edt-peso').val(),
        CODI_RAFECTO5: $('#edt-afecto-adicional').val(),
        IMP_ADICIONAL: $('#edt-impuesto').val(),
        codi_arancelario: $('#edt-code-arancelario').val(),
        clco_codigo: $('#edt-clasificacion-producto').val(),
        clco_codigo2: $('#edt-clasificacion-mercancia').val(),
        prod_mayor: $('#edt-mayorista').val(),
        estado: $('#edt-state').val(),
        _token: $("meta[name='csrf-token']").attr("content")
    }
    let current = JSON.parse(localStorage.getItem('mercancia'));
    $.ajax({
      type:'POST',
      url:'/productos/update-one',
      data: data,
    }).then((data) => {

    })
  }
  function getNutricional(id){
    $.ajax({
      type: 'GET',
      url: '/productos/nutricionals',
      data: {id: id},
    }).then((data) => {
      $('#info-code').val(data[0].codigo)
      $('#info-porcion').val(data[0].porcion)
      $('#info-calorias').val(data[0].energia)
      $('#info-grasas-totales').val(data[0].grasa_total)
      $('#info-grasas-saturadas').val(data[0].ac_grasa_sat)
      $('#info-grasas-trans').val(data[0].ac_grasa_trans)
      $('#info-mono-insaturada').val(data[0].ac_grasa_mono)
      $('#info-poli-saturada').val(data[0].ac_grasa_poli)
      $('#info-colesterol').val(data[0].colesterol)
      $('#info-sodio').val(data[0].sodio)
      $('#info-total-carbohidratos').val(data[0].hidrato_carbono)
      $('#info-azucar').val(data[0].azucar)
      $('#info-proteinas').val(data[0].proteina)
      $('#info-vitamina-a').val(data[0].vitaminaa)
      $('#info-vitamina-c').val(data[0].vitaminac)
      $('#info-calcio').val(data[0].calcio)
      $('#info-hierro').val(data[0].hierro)
    })
  }
  function getUnidadMedida(id) {
    $.ajax({
      type: 'GET',
      url: '/productos/unidades/list'
    }).then((data) => {
      const html = setUnidad(data);
      $('#edt-unid-media').empty().append(html);
    })
  }
  function getClasificacion() {
    $.ajax({
      type: 'GET',
      url: '/clasificacion/list'
    }).then((data) => {
      const html = setHTMLCla(data);
      $('#edt-clasificacion-producto').empty().append(html);
    })
  }
  function getClasificacion2() {
    $.ajax({
      type: 'GET',
      url: '/clasificacion/list2'
    }).then((data) => {
      const html = setHTMLCla2(data);
      $('#edt-clasificacion-mercancia').empty().append(html);
    })
  }
  function setUnidad(data) {
    let array = [];
    let current = JSON.parse(localStorage.getItem('mercancia'));
    for (var i = 0; i < data.length; i++) {
      if (data[i].TUME_CODIGO == current.TUME_CODIGO) {

        array[i] = `<option value='${data[i].TUME_CODIGO}' selected>${data[i].TUME_DESCR}</option>`;
      } else {
        array[i] = `<option value='${data[i].TUME_CODIGO}'>${data[i].TUME_DESCR}</option>`;
      }
    }

    return array;
  }
  function setHTMLCla(data) {
    let array = [];
    let current = JSON.parse(localStorage.getItem('mercancia'));
    for (var i = 0; i < data.length; i++) {
      if (data[i].CLCO_CODIGO == current.clco_codigo) {
        array[i] = `<option value='${data[i].CLCO_CODIGO}' selected>${data[i].CLCO_DESCRIPCION}</option>`;
      } else {
        array[i] = `<option value='${data[i].CLCO_CODIGO}'>${data[i].CLCO_DESCRIPCION}</option>`;
      }
    }
    return array;
  }
  function setHTMLCla2(data) {
    let array = [];
    let current = JSON.parse(localStorage.getItem('mercancia'));
    for (var i = 0; i < data.length; i++) {
      if (data[i].clco_codigo == current.clco_codigo2) {
        array[i] = `<option value='${data[i].clco_codigo}' selected>${data[i].clco_descripcion}</option>`;
      } else {
        array[i] = `<option value='${data[i].clco_codigo}'>${data[i].clco_descripcion}</option>`;
      }
    }
    return array;
  }
  function updateNutricional() {
    let data = {
      codigo: $('#info-code').val(),
      porcion: $('#info-porcion').val(),
      energia: $('#info-calorias').val(),
      grasa_total: $('#info-grasas-totales').val(),
      ac_grasa_sat: $('#info-grasas-saturadas').val(),
      ac_grasa_trans: $('#info-grasas-trans').val(),
      ac_grasa_mono: $('#info-mono-insaturada').val(),
      ac_grasa_poli: $('#info-poli-saturada').val(),
      colesterol: $('#info-colesterol').val(),
      sodio: $('#info-sodio').val(),
      hidrato_carbono: $('#info-total-carbohidratos').val(),
      azucar: $('#info-azucar').val(),
      proteina: $('#info-proteinas').val(),
      vitaminaa: $('#info-vitamina-a').val(),
      vitaminac: $('#info-vitamina-c').val(),
      calcio: $('#info-calcio').val(),
      hierro: $('#info-hierro').val(),
      _token: $("meta[name='csrf-token']").attr("content"),

    }
    $.ajax({
      type:'POST',
      url:'/products/nutricionals/update',
      data: data,
    }).then((data) => {

    })
  }
 })
