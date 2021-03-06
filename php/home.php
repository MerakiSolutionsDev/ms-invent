<?php
    SESSION_START();
    if(!isset($_SESSION['db'])){
        header("Location: http://localhost/meraki-rent/ms-invent/html/login.html");
        exit();
    }
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="author" content="G.Alarcón">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/meraki-1.0.0.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-ana.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Antic+Slab|Raleway|Great+Vibes|Playfair+Display+SC|Poiret+One|Lato:400" rel="stylesheet">
    <script src="http://cdn.jsdelivr.net/alasql/0.3/alasql.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.7.12/xlsx.core.min.js"></script>
    <script src="https://www.w3schools.com/lib/w3.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="../javascript/w3data.js"></script>
    <script src="../javascript/jquery-dateFormat.min.js"></script>
    <script src="../javascript/merakiScripting.js"></script>
    <title>Inventarios y Cardex</title>
    <style media="screen">
        .meraki-search {
            background-image: url('../images/searchicon.png');
            background-size: 25px, 25px;
            background-position: 10px 12px; /* Position the search icon */
            background-repeat: no-repeat; /* Do not repeat the icon image */
            font-size: 16px; /* Increase font-size */
            padding: 12px 20px 12px 40px; /* Add some padding */
            border: 1px solid #ddd; /* Add a grey border */
            margin-bottom: 12px; /* Add some space below the input */
        }

        .meraki-font-s1 {
            font-family: 'Yellowtail', cursive;
        }

        .meraki-font-s2 {
            font-family: 'Poiret One', cursive;
        }

        .meraki-font-s3 {
            font-family: 'Playfair Display SC', cursive;
        }

        .meraki-font-s4 {
            font-family: 'Great Vibes', cursive;
        }

        .meraki-font-s5 {
            font-family: 'Lato', sans-serif;
        }

        .meraki-font-s6 {
            font-family: 'Raleway', sans-serif;
        }

        .meraki-border-bottom {
            border-bottom-style: solid;
            border-bottom-color: #f8a300;
        }

        @keyframes closeMe {
          to {
            height: 0px;
          }
        }
    </style>
</head>

<body ng-app="ZSApp">

    <div class="meraki-font-s6 w3-sidebar w3-bar-block w3-card-2 w3-animate-left w3-hide-small" id="sidebarMenu" style="display:none;">
        <button class="w3-bar-item w3-button w3-large w3-ana-509" onclick="w3_close()">Close &times;</button>
        <a title="Aquí puede crear nuevas zonas o sucursales" href="" class="w3-bar-item w3-button w3-border-bottom meraki-nav-class" onclick="w3.hide('.cardexBlock'); w3.show('#zonas-sucursales'); w3_close(); activeLink(event, 'meraki-nav-class')"><i class="fa fa-map-marker fa-fw" aria-hidden="true" style="width:25px"></i> Zonas o Sucursales</a>
        <a title="Aquí puede crear nuevos clientes, proveedores o internos" href="" class="w3-bar-item w3-button w3-border-bottom meraki-nav-class" onclick="w3.hide('.cardexBlock'); w3.show('#terceros'); w3_close(); activeLink(event, 'meraki-nav-class')"><i class="fa fa-users fa-fw" aria-hidden="true" style="width:25px"></i> Terceros</a>
        <a title="Aquí puede crear nuevos documentos de trabajo, para luego usarlos en sus operaciones" href="" class="w3-bar-item w3-button w3-border-bottom meraki-nav-class" onclick="w3.hide('.cardexBlock'); w3.show('#documentos'); w3_close(); activeLink(event, 'meraki-nav-class')"><i class="fa fa-file-text-o fa-fw" aria-hidden="true" style="width:25px"></i> Documentos</a>
        <a title="Aquí puede crear nuevos grupos o categorias de productos" href="" class="w3-bar-item w3-button w3-border-bottom meraki-nav-class" onclick="w3.hide('.cardexBlock'); w3.show('#grupos'); w3_close(); activeLink(event, 'meraki-nav-class')"><i class="fa fa-object-group fa-fw" aria-hidden="true" style="width:25px"></i> Grupos de Productos</a>
        <a title="Aquí puede crear nuevos productos" href="" class="w3-bar-item w3-button w3-border-bottom meraki-nav-class" onclick="w3.hide('.cardexBlock'); w3.show('#productos'); w3_close(); activeLink(event, 'meraki-nav-class')"><i class="fa fa-product-hunt fa-fw" aria-hidden="true" style="width:25px"></i> Productos</a>
        <a title="Aquí puede registrar el movimiento de mercancía, utilizando todos los datos creados anteriormente" href="" class="w3-bar-item w3-button w3-border-bottom meraki-nav-class" onclick="w3.hide('.cardexBlock'); w3.show('#regdocumentos'); w3_close(); activeLink(event, 'meraki-nav-class')"><i class="fa fa-pencil-square-o fa-fw" aria-hidden="true" style="width:25px"></i> Registrar Movimientos</a>
        <a title="Aquí puede editar los movimientos realizados" href="" class="w3-bar-item w3-button w3-border-bottom w3-border-black meraki-nav-class" onclick="w3.hide('.cardexBlock'); w3.show('#edit-documentos'); w3_close(); activeLink(event, 'meraki-nav-class')"><i class="fa fa-pencil fa-fw" aria-hidden="true" style="width:25px"></i> Editar Movimientos</a>
        <a title="Aquí puede consultas sobre los movimientos de sus productos" href="" class="w3-bar-item w3-button w3-border-bottom meraki-nav-class" onclick="w3.hide('.cardexBlock'); w3.show('#consultas'); w3_close(); activeLink(event, 'meraki-nav-class')"><i class="fa fa-flag fa-fw" aria-hidden="true" style="width:25px"></i> Cardex</a>
        <a title="Aquí puede descargar informes especificos en formato Excel" href="" class="w3-bar-item w3-button w3-border-bottom meraki-nav-class" onclick="w3.hide('.cardexBlock'); w3.show('#informes'); w3_close(); activeLink(event, 'meraki-nav-class')"><i class="fa fa-book fa-fw" aria-hidden="true" style="width:25px"></i>&nbsp; Informes</a>
    </div>

    <div class="meraki-font-s6 w3-sidebar w3-bar-block w3-card-2 w3-animate-left w3-hide-large w3-hide-medium" id="sidebarMenu-small" style="display:none;">
        <button class="w3-bar-item w3-button w3-large w3-ana-509" onclick="w3_close();">Close &times;</button>
        <a title="Aquí puede crear nuevas zonas o sucursales" href="" class="w3-bar-item w3-button w3-border-bottom meraki-nav-class" onclick="w3.hide('.cardexBlock'); w3.show('#zonas-sucursales'); w3_close(); activeLink(event, 'meraki-nav-class')"><i class="fa fa-map-marker fa-fw" aria-hidden="true" style="width:25px"></i> Zonas o Sucursales</a>
        <a title="Aquí puede crear nuevos clientes, proveedores o internos" href="" class="w3-bar-item w3-button w3-border-bottom meraki-nav-class" onclick="w3.hide('.cardexBlock'); w3.show('#terceros'); w3_close(); activeLink(event, 'meraki-nav-class')"><i class="fa fa-users fa-fw" aria-hidden="true" style="width:25px"></i> Terceros</a>
        <a title="Aquí puede crear nuevos documentos de trabajo, para luego usarlos en sus operaciones" href="" class="w3-bar-item w3-button w3-border-bottom meraki-nav-class" onclick="w3.hide('.cardexBlock'); w3.show('#documentos'); w3_close(); activeLink(event, 'meraki-nav-class')"><i class="fa fa-file-text-o fa-fw" aria-hidden="true" style="width:25px"></i> Documentos</a>
        <a title="Aquí puede crear nuevos grupos o categorias de productos" href="" class="w3-bar-item w3-button w3-border-bottom meraki-nav-class" onclick="w3.hide('.cardexBlock'); w3.show('#grupos'); w3_close(); activeLink(event, 'meraki-nav-class')"><i class="fa fa-object-group fa-fw" aria-hidden="true" style="width:25px"></i> Grupos de Productos</a>
        <a title="Aquí puede crear nuevos productos" href="" class="w3-bar-item w3-button w3-border-bottom meraki-nav-class" onclick="w3.hide('.cardexBlock'); w3.show('#productos'); w3_close(); activeLink(event, 'meraki-nav-class')"><i class="fa fa-product-hunt fa-fw" aria-hidden="true" style="width:25px"></i> Productos</a>
        <a title="Aquí puede registrar el movimiento de mercancía, utilizando todos los datos creados anteriormente" href="" class="w3-bar-item w3-button w3-border-bottom meraki-nav-class" onclick="w3.hide('.cardexBlock'); w3.show('#regdocumentos'); w3_close(); activeLink(event, 'meraki-nav-class')"><i class="fa fa-pencil-square-o fa-fw" aria-hidden="true" style="width:25px"></i> Registrar Movimientos</a>
        <a title="Aquí puede editar los movimientos realizados" href="" class="w3-bar-item w3-button w3-border-bottom w3-border-black meraki-nav-class" onclick="w3.hide('.cardexBlock'); w3.show('#edit-documentos'); w3_close(); activeLink(event, 'meraki-nav-class')"><i class="fa fa-pencil fa-fw" aria-hidden="true" style="width:25px"></i> Editar Movimientos</a>
        <a title="Aquí puede consultas sobre los movimientos de sus productos" href="" class="w3-bar-item w3-button w3-border-bottom meraki-nav-class" onclick="w3.hide('.cardexBlock'); w3.show('#consultas'); w3_close(); activeLink(event, 'meraki-nav-class')"><i class="fa fa-flag fa-fw" aria-hidden="true" style="width:25px"></i> ardex</a>
        <a title="Aquí puede descargar informes especificos en formato Excel" href="" class="w3-bar-item w3-button w3-border-bottom meraki-nav-class" onclick="w3.hide('.cardexBlock'); w3.show('#informes'); w3_close(); activeLink(event, 'meraki-nav-class')"><i class="fa fa-book fa-fw" aria-hidden="true" style="width:25px"></i>&nbsp; Informes</a>
    </div>

    <div zclass="w3-main" id="main">
        <div class="w3-ana-502 w3-padding meraki-border-bottom w3-top">
            <button class="w3-button w3-ana-509 w3-hover-sand w3-xlarge w3-round-large w3-hide-small" onclick="w3_open()">&#9776;</button>
            <button class="w3-button w3-ana-509 w3-xlarge w3-round-large w3-hide-large w3-hide-medium" onclick="w3_open_small()">&#9776;</button><span class="w3-right w3-margin-right w3-hide-small"><h2 class="meraki-font-s2">Inventarios y Kardex</h2></span>
            <span class="w3-right w3-margin-right w3-hide-large w3-hide-medium"><h2 class="meraki-font-s2 w3-large">Inventarios y Kardex</h2></span>

        </div>

        <div class="w3-container w3-dark-grey" onclick="w3_close();">

            <div id="Welcome" class="cardexBlock w3-container w3-display-container" style="height: 100vh;">
                <div class="w3-display-middle">
                    <h1 class="meraki-font-s4 w3-text-white" style="font-size: 10vw;">Welcome!</h1>
                </div>
            </div>

            <!--************ GESTION DE ZONAS o SUCURSALES ***************-->
            <div id="zonas-sucursales" class="cardexBlock w3-container w3-padding w3-animate-top" ng-controller="ZSCtrl" style="display: none; margin-top: 75px;">
                <div class="w3-container w3-ana-509 w3-card-4 w3-round-medium">
                    <h4 class="meraki-font-s6">Zonas o Sucursales</h4>
                </div>

                <div class="w3-row">
                    <div class="w3-col s0 m3 l3">
                        <p></p>
                    </div>
                    <div class="w3-col s12 m6 l6">
                        <form method="post" class="ajax meraki-font-s6">
                            <h4>ID Zona o Sucursal</h4>
                            <input id="ZSInputID" class="w3-input w3-border w3-round-medium" type="text" name="ID_ZonaSucursal" placeholder="ID" disabled>
                            <input id="ZSInputID_form" class="w3-input w3-border w3-round-medium" type="text" name="ID_ZonaSucursal_form" style="display:none;">
                            <h4>Nombre</h4>
                            <input ng-model="nuevaZS.Nombre" id="ZSInputNombre" class="w3-input w3-border w3-round-medium" type="text" name="nombre_ZonaSucursal" placeholder="Nombre de la Zona o Sucursal" required>

                            <h4>Dirección</h4>
                            <input ng-model="nuevaZS.Direccion" id="ZSInputDireccion" class="w3-input w3-border w3-round-medium" type="text" name="direccion_ZonaSucursal" placeholder="Dirección de la Zona o Sucursal" required>

                            <h4>Teléfono</h4>
                            <input ng-model="nuevaZS.Telefono" id="ZSInputTelefono" class="w3-input w3-border w3-round-medium" type="text" name="tel_ZonaSucursal" placeholder="Teléfono">

                            <h4>Detalles</h4>
                            <input ng-model="nuevaZS.Detalle" id="ZSInputDetalles" class="w3-input w3-border w3-round-medium" type="text" name="detalles_ZonaSucursal" placeholder="Información adicional">

                            <hr class="w3-border w3-border-red">

                            <div class="w3-row-padding w3-center w3-margin-top">
                                <div class="w3-third">
                                    <input style="margin-top: 5px" ng-mouseleave="updateZSTable()" class="w3-btn w3-ana-502 meraki-border-bottom w3-round-medium" type="submit" name="CrearZS" value="Crear">
                                </div>
                                <div class="w3-third">
                                    <input style="margin-top: 5px" ng-mouseleave="updateZSTable();" class="w3-btn w3-ana-502 meraki-border-bottom w3-round-medium" type="submit" name="ModificarZS" value="Modificar">
                                </div>
                                <div class="w3-third">
                                    <button style="margin-top: 5px" class="w3-btn w3-ana-502 meraki-border-bottom w3-round-medium" type="button" ng-click="exportData_zonasSucursales()">Exportar</button>
                                </div>
                            </div>
                        </form>
                        <input class="meraki-font-s6 meraki-search w3-input w3-animate-input w3-light-grey w3-margin-top w3-round-medium" type="text"  ng-model="zs_filter" placeholder=" filtrar contenido" style="width:50%">
                    </div>
                    <div class="w3-col s0 m3 l3">
                        <p></p>
                    </div>
                </div>


                <div class="w3-container w3-margin-top w3-responsive">

                    <table class="w3-table-all w3-text-dark-grey w3-card-4">
                        <tr>
                            <th ng-click="orderByMe('ID')">ID</th>
                            <th ng-click="orderByMe('Nombre')">Nombre</th>
                            <th ng-click="orderByMe('Direccion')">Dirección</th>
                            <th ng-click="orderByMe('Telefono')">Teléfono</th>
                            <th ng-click="orderByMe('Detalle')">Detalles</th>
                        </tr>
                        <tr class="zs-table w3-hover-blue-gray" ng-repeat="x in data_zonasSucursales | orderBy:myOrderBy | filter:zs_filter" onclick="ZS_showCells(this); activeLink(event, 'zs-table')">
                            <td>{{ x.ID }}</td>
                            <td>{{ x.Nombre }}</td>
                            <td>{{ x.Direccion }}</td>
                            <td>{{ x.Telefono }}</td>
                            <td>{{ x.Detalle }}</td>
                        </tr>
                    </table>
                </div>
                <div class="w3-container" style="height:50vh;">
                    <p></p>
                </div>
            </div>

            <!--************ GESTION DE TERCEROS ***************-->
            <div id="terceros" class="cardexBlock w3-container w3-padding w3-animate-right" ng-controller="terceros-Ctrl" style="display: none; margin-top: 75px">
                <div class="w3-container w3-ana-509 w3-card-4 w3-round-medium">
                    <h4 class="meraki-font-s6">Terceros</h4>
                </div>

                <div class="w3-row">
                    <div class="w3-col s0 m3 l3">
                        <p></p>
                    </div>
                    <div class="w3-col s12 m6 l6">
                        <form method="post" class="ajax-terceros meraki-font-s6">
                            <input id="terceros-InputID_form" class="w3-input w3-border" type="text" name="ID_terceros_form" style="display:none;">
                            <div class="w3-row w3-margin-top">
                                <div class="w3-col s6 m7 l7">
                                    <label>N° de Identi.</label>
                                    <input id="terceros-InputIdenti" class="meraki-font-s5 w3-input w3-border w3-round-medium" type="text" name="identi_terceros" placeholder="N°" required>
                                </div>
                                <div class="w3-col m1 l1">
                                    <p></p>
                                </div>
                                <div class="w3-col s6 m4 l4">
                                    <label>Tipo de Identi.</label>
                                    <select id="terceros-InputIdentiClass" class="w3-select w3-round-medium" name="identiclass_terceros" title="Identificación">
                                        <option value="RUC" selected>RUC</option>
                                        <option value="DNI">D.N.I.</option>
                                        <option value="OTRO">Otro</option>

                                    </select>
                                </div>
                            </div>

                            <div class="w3-row w3-margin-top">
                                <label>Tipo de Tercero</label>
                                <select id="terceros-InputTerceroClass" class="w3-select w3-round-medium" name="terceroclass_terceros" title="Tipo de tercero">
                                    <option value="PROVEEDOR" selected>Proveedor</option>
                                    <option value="CLIENTE">Cliente</option>
                                    <option value="INTERNO">Interno</option>
                                </select>
                            </div>
                            <hr>



                            <h4>Nombre</h4>
                            <input id="terceros-InputNombre" class="w3-input w3-border w3-round-medium" type="text" name="nombre_terceros" placeholder="Nombre del tercero" required>
                            <h4>Ciudad</h4>
                            <input id="terceros-InputCiudad" class="w3-input w3-border w3-round-medium" type="text" name="ciudad_terceros" placeholder="Lima, Arequipa, Mollendo">
                            <h4>Dirección</h4>
                            <input id="terceros-InputDireccion" class="w3-input w3-border w3-round-medium" type="text" name="direccion_terceros" placeholder="Calle, Av., Jr.">
                            <h4>Teléfonos</h4>
                            <input id="terceros-InputTel" class="w3-input w3-border w3-round-medium" type="text" name="tel_terceros" placeholder="Fijo o Celular">
                            <h4>Detalles</h4>
                            <input id="terceros-InputDetalles" class="w3-input w3-border w3-round-medium" type="text" name="detalles_terceros" placeholder="Información adicional">

                            <hr class="w3-border w3-border-red">
                            <div class="w3-row w3-center w3-margin-top">
                                <div class="w3-third w3-padding">
                                    <input style="margin-top: 5px" ng-mouseleave="updateTercerosTable();" class="w3-btn w3-ana-502 meraki-border-bottom w3-round-medium" type="submit" name="Crear-terceros" value="Crear">
                                </div>
                                <div class="w3-third w3-padding">
                                    <input style="margin-top: 5px" ng-mouseleave="updateTercerosTable();" class="w3-btn w3-ana-502 meraki-border-bottom w3-round-medium" type="submit" name="Modificar-terceros" value="Modificar">
                                </div>
                                <div class="w3-third w3-padding">
                                    <button style="margin-top: 5px" ng-mouseleave="updateTercerosTable();" class="w3-btn w3-ana-502 meraki-border-bottom w3-round-medium" type="button" ng-click="exportData_terceros()">Exportar</button>
                                </div>
                            </div>
                        </form>
                        <input class="meraki-search w3-input w3-animate-input w3-light-grey w3-round-medium w3-margin-top" type="text"  ng-model="terceros_filter" placeholder="filtrar contenido" style="width:50%">
                    </div>
                    <div class="w3-col s0 m3 l3">
                        <p></p>
                    </div>
                </div>



                <div class="w3-container w3-margin-top w3-responsive w3-margin-bottom">

                    <table class="w3-table-all w3-responsive w3-card-4 w3-text-dark-grey">
                        <tr>
                            <th ng-click="orderByMe('ID')">ID</th>
                            <th ng-click="orderByMe('Identi')">N°</th>
                            <th ng-click="orderByMe('IdentiClass')">Doc. Identi.</th>
                            <th ng-click="orderByMe('TerceroClass')">Tipo</th>
                            <th ng-click="orderByMe('Nombre')">Nombre</th>
                            <th ng-click="orderByMe('Ciudad')">Ciudad</th>
                            <th ng-click="orderByMe('Direccion')">Dirección</th>
                            <th ng-click="orderByMe('Tel')">Teléfono</th>
                            <th ng-click="orderByMe('Detalles')">Detalles</th>
                        </tr>
                        <tr class="terceros-table w3-hover-blue-gray" ng-repeat="x in data_terceros | orderBy:myOrderBy | filter:terceros_filter" onclick="terceros_showCells(this); activeLink(event, 'terceros-table')">
                            <td>{{ x.ID }}</td>
                            <td>{{ x.Identi }}</td>
                            <td>{{ x.IdentiClass }}</td>
                            <td>{{ x.TerceroClass }}</td>
                            <td>{{ x.Nombre }}</td>
                            <td>{{ x.Ciudad }}</td>
                            <td>{{ x.Direccion }}</td>
                            <td>{{ x.Tel }}</td>
                            <td>{{ x.Detalles }}</td>
                        </tr>
                    </table>
                </div>
                <div class="w3-container" style="height:50vh;">
                    <p></p>
                </div>
            </div>

            <!--************ GESTION DE DOCUMENTOS ***************-->
            <div id="documentos" class="cardexBlock w3-container w3-padding w3-animate-top" ng-controller="documentos-Ctrl" style="display: none; margin-top: 75px;">
                <div class="w3-container w3-ana-509 w3-card-4 w3-round-medium">
                    <h4 class="meraki-font-s6" >Documentos</h4>
                </div>

                <div class="w3-row">
                    <div class="w3-col s0 m3 l3">
                        <p></p>
                    </div>
                    <div class="w3-col s12 m6 l6">
                        <form method="post" class="ajax-documentos meraki-font-s6">
                            <h4>ID de Documento</h4>
                            <input id="documentos-InputID" class="w3-input w3-border w3-round-medium" type="text" name="ID_documentos" placeholder="ID" disabled>
                            <input id="documentos-InputID_form" class="w3-input w3-border" type="text" name="ID_documentos_form" style="display:none;">
                            <hr>

                            <h4>Nuevo Documento</h4>
                            <div class="w3-row">
                                <div class="w3-col s12 m2">
                                    <label>Abreviatura</label>
                                    <input id="documentos-InputAbrev" class="w3-input w3-border w3-round-medium" type="text" name="abrev_documentos" placeholder="Abrev." title="Abreviatura de Documento" required>
                                </div>
                                <div class="w3-col s0 m1">
                                    <p></p>
                                </div>
                                <div class="w3-col s12 m9">
                                    <label for="">Nombre del Documento</label>
                                    <input id="documentos-InputNombre" class="w3-input w3-border w3-round-medium" type="text" name="nombre_documentos" placeholder="Nombre" required>
                                </div>
                            </div>
                            <p></p>
                            <div class="w3-row">
                                <div class="w3-col m3">
                                    <p></p>
                                </div>
                                <div class="w3-col s12 m4">
                                    <label>Naturaleza</label>
                                    <select id="documentos-InputNaturaleza" class="w3-select w3-round-medium" name="naturaleza_documentos" title="Tipo de Documento">
                                        <option value="" disabled selected>Seleccionar</option>
                                        <option value="entrada">ENTRADA</option>
                                        <option value="salida">SALIDA</option>
                                        <option value="ajuste">AJUSTE</option>
                                    </select>
                                </div>
                                <div class="w3-col m1">
                                    <p></p>
                                </div>
                                <div class="w3-col s12 m4">
                                    <label>Tipo</label>
                                    <select id="documentos-InputTipo" class="w3-select w3-round-medium" name="tipo_documentos" title="Tipo de Documento">
                                        <option value="" disabled selected>Seleccionar</option>
                                        <option value="cliente">CLIENTE</option>
                                        <option value="proveedor">PROVEEDOR</option>
                                        <option value="interno">INTERNO</option>
                                    </select>
                                </div>
                            </div>
                            <hr>

                            <h4>Modo de uso</h4>
                            <input id="documentos-InputUso" class="w3-input w3-border w3-round-medium" type="text" name="uso_documentos" placeholder="Información sobre el uso del documento">

                            <h4>Detalles</h4>
                            <input id="documentos-InputDetalles" class="w3-input w3-border w3-round-medium" type="text" name="detalles_documentos" placeholder="Información adicional">
                            <hr class="w3-border w3-border-red">

                            <div class="w3-row-padding w3-center w3-margin-top">
                                <div class="w3-third w3-padding">
                                    <input style="margin-top: 5px" ng-mouseleave="updateDocumentosTable()" class="w3-btn  w3-ana-502 meraki-border-bottom w3-round-medium" type="submit" name="Crear-documentos" value="Crear">
                                </div>
                                <div class="w3-third w3-padding">
                                    <input style="margin-top: 5px" ng-mouseleave="updateDocumentosTable();" class="w3-btn w3-ana-502 meraki-border-bottom w3-round-medium" type="submit" name="Modificar-documentos" value="Modificar">
                                </div>
                                <div class="w3-third w3-padding">
                                    <button style="margin-top: 5px" class="w3-btn w3-ana-502 meraki-border-bottom w3-round-medium" type="button" ng-click="exportData_documentos()">Exportar</button>
                                </div>
                            </div>
                        </form>
                        <input class="meraki-search w3-input w3-animate-input w3-light-grey w3-round-medium w3-margin-top" type="text"  ng-model="documentos_filter" placeholder="filtrar contenido" style="width:50%">
                    </div>
                    <div class="w3-col s0 m3 l3">
                        <p></p>
                    </div>
                </div>


                <div class="w3-container w3-margin-top w3-responsive">
                    <table class="w3-table-all w3-card-4 w3-text-dark-grey">
                        <tr>
                            <th ng-click="orderByMe('ID')">ID</th>
                            <th ng-click="orderByMe('Abrev')">Abrev.</th>
                            <th ng-click="orderByMe('Nombre')">Nombre</th>
                            <th ng-click="orderByMe('Tipo')">Tipo</th>
                            <th ng-click="orderByMe('Naturaleza')">Naturaleza</th>
                            <th ng-click="orderByMe('Uso')">Modo de Uso</th>
                            <th ng-click="orderByMe('Detalle')">Detalles</th>
                        </tr>
                        <tr class="documentos-table w3-hover-blue-gray" ng-repeat="x in data_documentos | orderBy:myOrderBy | filter:documentos_filter" onclick="documentos_showCells(this); activeLink(event, 'documentos-table')">
                            <td>{{ x.ID }}</td>
                            <td>{{ x.Abrev }}</td>
                            <td>{{ x.Nombre }}</td>
                            <td>{{ x.Tipo }}</td>
                            <td>{{ x.Naturaleza }}</td>
                            <td>{{ x.Uso }}</td>
                            <td>{{ x.Detalle }}</td>
                        </tr>
                    </table>
                </div>

                <div class="w3-container" style="height:50vh;">
                    <p></p>
                </div>
            </div>

            <!--************ GESTION DE GRUPOS ***************-->
            <div id="grupos" class="cardexBlock w3-container w3-padding w3-animate-top" ng-controller="grupos-Ctrl" style="display: none; margin-top: 75px;">
                <div class="w3-container w3-ana-509 w3-card-4 w3-round-medium">
                    <h4 class="meraki-font-s6">Grupos de Productos</h4>
                </div>

                <div class="w3-row">
                    <div class="w3-col s0 m3 l3">
                        <p></p>
                    </div>
                    <div class="w3-col s12 m6 l6">
                        <form method="post" class="ajax-grupos meraki-font-s6">
                            <h4>ID de Grupo</h4>
                            <input id="grupos-InputID" class="w3-input w3-border w3-round-medium w3-brown" type="text" name="ID_grupos" placeholder="ID" disabled>
                            <input id="grupos-InputID_form" class="w3-input w3-border w3-round-medium" type="text" name="ID_grupos_form" style="display:none;">
                            <h4>Nombre</h4>
                            <input id="grupos-InputNombre" class="w3-input w3-border w3-round-medium" type="text" name="nombre_grupos" placeholder="Nombre del grupo" required>

                            <h4>Detalles</h4>
                            <input id="grupos-InputDetalles" class="w3-input w3-border w3-round-medium" type="text" name="detalles_grupos" placeholder="Información adicional">
                            <hr class="w3-border w3-border-red">

                            <div class="w3-row-padding w3-center w3-margin-top">
                                <div class="w3-third w3-padding">
                                    <input style="margin-top: 5px" ng-mouseleave="updateGruposTable()" class="w3-btn  w3-ana-502 meraki-border-bottom w3-round-medium" type="submit" name="Crear-grupos" value="Crear">
                                </div>
                                <div class="w3-third w3-padding">
                                    <input style="margin-top: 5px" ng-mouseleave="updateGruposTable();" class="w3-btn  w3-ana-502 meraki-border-bottom w3-round-medium" type="submit" name="Modificar-grupos" value="Modificar">
                                </div>
                                <div class="w3-third w3-padding">
                                    <button style="margin-top: 5px" class="w3-btn w3-ana-502 meraki-border-bottom w3-round-medium" type="button" ng-click="exportData_grupos()">Exportar</button>
                                </div>
                            </div>
                        </form>
                        <input class="meraki-search w3-input w3-animate-input w3-light-grey w3-margin-top w3-round-medium" type="text"  ng-model="grupos_filter" placeholder="filtrar contenido" style="width:50%">
                    </div>
                    <div class="w3-col s0 m3 l3">
                        <p></p>
                    </div>
                </div>

                <div class="w3-container w3-margin-top w3-responsive">
                    <table class="w3-table-all w3-card-4 w3-text-dark-grey">
                        <tr>
                            <th ng-click="orderByMe('ID')">ID</th>
                            <th ng-click="orderByMe('Nombre')">Nombre</th>
                            <th ng-click="orderByMe('Detalle')">Detalles</th>
                        </tr>
                        <tr class="grupos-table w3-hover-blue-gray" ng-repeat="x in data_grupos | orderBy:myOrderBy | filter:grupos_filter" onclick="grupos_showCells(this); activeLink(event, 'grupos-table')">
                            <td>{{ x.ID }}</td>
                            <td>{{ x.Nombre }}</td>
                            <td>{{ x.Detalle }}</td>
                        </tr>
                    </table>
                </div>
                <div class="w3-container" style="height:50vh;">
                    <p></p>
                </div>
            </div>

            <!--************ GESTION DE PRODUCTOS ***************-->
            <div id="productos" class="cardexBlock w3-container w3-padding w3-animate-right" ng-controller="productos-Ctrl" style="display: none; margin-top: 75px;">
                <div class="w3-container w3-ana-509 w3-card-4 w3-round-medium">
                    <h4 class="meraki-font-s6">Productos</h4>
                </div>

                <div class="w3-row">
                    <div class="w3-col s0 m2 l3">
                        <p></p>
                    </div>
                    <div class="w3-col s0 m8 l6">
                        <form method="post" class="ajax-productos meraki-font-s6">
                            <h4>ID Producto</h4>
                            <input id="productos-InputID" class="w3-input w3-border w3-round-medium" type="text" name="ID_productos" placeholder="ID" disabled>
                            <input id="productos-InputID_form" class="w3-input w3-border" type="text" name="ID_productos_form" placeholder="ID" style="display:none;">
                            <hr>
                            <div class="w3-row">
                                <div class="w3-col m2 l2">
                                    <h4>Grupo</h4>
                                </div>
                                <div class="w3-col m6 l6">
                                    <select id="productos-InputGrupo" class="w3-select w3-round-medium" name="grupo_productos" title="Grupo de Producto" ng-model="productos_gp" ng-init="productos_gp = ''" ng-mousedown = "updateGruposTable()">
                                      <option value="" disabled selected>Seleccione</option>
                                      <option ng-repeat = "gp in data_grupos" value="{{gp.Nombre | filter:uppercase}}">{{gp.Nombre}}</option>
                                    </select>
                                </div>
                                <div class="w3-col m1 l1">
                                    <p></p>
                                </div>
                                <div class="w3-col m3 l3" ng-repeat="gp in data_grupos | filter:productos_gp">
                                    <input id="productos-InputIDGrupo" class="w3-input w3-border w3-round-medium" type="text" name="idgrupo_productos" placeholder="ID = {{ gp.ID}}" ng-if="productos_gp !== ''" disabled>
                                </div>
                            </div>
                            <p></p>
                            <div class="w3-row">
                                <div class="w3-col m2 l2">
                                    <h4>Zona</h4>
                                </div>
                                <div class="w3-col m6 l6">
                                    <select id="productos-InputZona" class="w3-select w3-round-medium" name="zona_productos" title="Zona de Producto" ng-model="productos_zs" ng-init="productos_zs = ''" ng-mousedown = "updateZSTable()">
                                        <option value="" disabled selected>Seleccione</option>
                                        <option ng-repeat = "zs in data_zonasSucursales" value="{{zs.Nombre}}">{{zs.Nombre}}</option>
                                    </select>
                                </div>
                                <div class="w3-col m1 l1">
                                    <p></p>
                                </div>
                                <div class="w3-col m3 l3" ng-repeat="zs in data_zonasSucursales | filter:productos_zs">
                                    <input id="productos-InputIDZS" class="w3-input w3-border w3-round-medium" type="text" name="idzs_productos" placeholder="ID = {{zs.ID}}" ng-if="productos_zs !== ''" disabled>
                                </div>
                            </div>
                            <hr>


                            <h4>Producto</h4>
                            <input id="productos-InputNombre" class="w3-input w3-border w3-round-medium" type="text" name="nombre_productos" placeholder="Nombre del Producto" required>

                            <h4>Unidad de medida</h4>
                            <input id="productos-InputUnidad" class="w3-input w3-border w3-round-medium" type="text" name="unidad_productos" placeholder="Unidad de medida">

                            <div class="w3-row-padding w3-margin-top">
                                <div class="w3-col m3 l3">
                                    <label class="w3-center" >Stock</labe>
                                    <input id="productos-InputStock" class="meraki-font-s5 w3-input w3-border w3-round-medium" type="number" name="stock_productos" ng-model="stock" min="0" value="0">
                                </div>
                                <div class="w3-col m3 l3">
                                    <label class="w3-center" >S.Emergencia</label>
                                    <input id="productos-InputStockE" class="meraki-font-s5 w3-input w3-border w3-round-medium" type="number" name="stocke_productos" ng-model="stocke" ng-keyup="Add()" min="0" value="0">
                                </div>
                                <div class="w3-col s0 m3 l3">
                                    <label class="w3-center" >Offset (%)</label>
                                    <input id="productos-InputOffset" class="meraki-font-s5 w3-input w3-border w3-round-medium" ng-model="stocka_offset" ng-keyup="Add()" type="number" name="offset_productos" min="0" value="0">
                                </div>
                                <div class="w3-col m3 l3">
                                    <label class="w3-center" >S.Alerta</label>
                                    <input id="productos-InputStockA" class="meraki-font-s5 w3-input w3-border w3-round-medium" type="text" name="stocka_productos" placeholder="Stock E. + Offset" value="{{stocka | number:0}}" disabled>
                                    <input id="productos-InputStockA_form" class="w3-input w3-border" type="text" name="stocka_productos_form" placeholder="Stock E. + Offset" style="display:none;" value="{{stocka | number:0}}">
                                </div>

                            </div>
                            <hr>

                            <h4>Detalles</h4>
                            <input id="productos-InputDetalles" class="w3-input w3-border w3-round-medium" type="text" name="detalles_productos" placeholder="Información adicional">
                            <h4>Tipo de Moneda</h4>
                            <select id="productos-InputMoneda" class="w3-select w3-round-medium" name="moneda_productos">
                                <option value="" selected disabled>Seleccionar</option>
                                <option value="PEN" >PEN</option>
                                <option value="USD" >USD</option>
                                <option value="EUR" >EUR</option>
                                <option value="JPN" >JPN</option>
                            </select>
                            <h4>Precio de Compra / <span>Costo de Fabricación</span></h4>
                            <input id="productos-InputCompra" class="meraki-font-s5 w3-input w3-border w3-round-medium" type="text" name="compra_productos">
                            <h4>Precio de Venta</h4>
                            <input id="productos-InputVenta" class="meraki-font-s5 w3-input w3-border w3-round-medium" type="text" name="venta_productos">

                            <hr class="w3-border w3-border-red">
                            <div class="w3-row-padding w3-center w3-margin-top">
                                <div class="w3-third w3-padding">
                                    <input style="margin-top: 5px" ng-mouseleave="updateProductosTable();" class="w3-btn w3-ana-502 meraki-border-bottom w3-round-medium" type="submit" name="Crear-productos" value="Crear">
                                </div>
                                <div class="w3-third w3-padding">
                                    <input style="margin-top: 5px" ng-mouseleave="updateProductosTable();" class="w3-btn w3-ana-502 meraki-border-bottom w3-round-medium" type="submit" name="Modificar-productos" value="Modificar">
                                </div>
                                <div class="w3-third w3-padding">
                                    <button style="margin-top: 5px" ng-mouseleave="updateProductosTable();" class="w3-btn w3-ana-502 meraki-border-bottom w3-round-medium" type="button" ng-click="exportData_productos()">exportar</button>
                                </div>
                            </div>
                        </form>
                        <input class="meraki-search w3-input w3-animate-input w3-light-grey w3-round-medium w3-margin-top" type="text"  ng-model="productos_filter" placeholder="filtrar contenido" style="width:50%">
                    </div>
                    <div class="w3-col s0 m2 l3">
                        <p></p>
                    </div>
                </div>

                <div class="w3-container w3-margin-top w3-margin-bottom w3-responsive">
                    <table class="w3-table-all w3-card-4 w3-text-dark-grey">
                        <tr>
                            <th ng-click="orderByMe('ID')">ID</th>
                            <th ng-click="orderByMe('Grupo')">Grupo</th>
                            <th ng-click="orderByMe('Zona')">Zona</th>
                            <th ng-click="orderByMe('Nombre')">Nombre</th>
                            <th ng-click="orderByMe('Unidad')">Unidad Medida</th>
                            <th ng-click="orderByMe('Stock')">Stock</th>
                            <th ng-click="orderByMe('StockE')">Stock E.</th>
                            <th ng-click="orderByMe('Offset')">Offset</th>
                            <th ng-click="orderByMe('StockA')">Stock A.</th>
                            <th ng-click="orderByMe('Moneda')">Moneda</th>
                            <th ng-click="orderByMe('Compra')">P. Compra</th>
                            <th ng-click="orderByMe('Venta')">P. Venta</th>
                            <th ng-click="orderByMe('Detalles')">Detalles</th>

                        </tr>
                        <tr class="productos-tables w3-hover-blue-gray" ng-repeat="x in data_productos | orderBy:myOrderBy | filter:productos_filter" onclick="productos_showCells(this); activeLink(event, 'productos-table')">
                            <td>{{ x.ID }}</td>
                            <td>{{ x.Grupo }}</td>
                            <td>{{ x.Zona }}</td>
                            <td>{{ x.Nombre }}</td>
                            <td>{{ x.Unidad }}</td>
                            <td>{{ x.Stock }}</td>
                            <td>{{ x.StockE }}</td>
                            <td>{{ x.Offset }}</td>
                            <td>{{ x.StockA }}</td>
                            <td>{{ x.Moneda }}</td>
                            <td>{{ x.Compra }}</td>
                            <td>{{ x.Venta }}</td>
                            <td>{{ x.Detalles }}</td>
                        </tr>
                    </table>
                </div>
                <div class="w3-container" style="height: 50vh">
                    <p></p>
                </div>
            </div>

            <!--************ REGISTRAR MOVIMIENTOS ***************-->
            <div id="regdocumentos" class="cardexBlock w3-container w3-padding w3-animate-right" ng-controller="regdocumentos-Ctrl" style="display: none; margin-top: 75px;">
                <div class="w3-container w3-ana-509 w3-card-4 w3-round-medium">
                    <h4 class="meraki-font-s6">Registrar Movimientos</h4>
                </div>

                <div class="w3-row">
                    <div class="w3-col s0 m2 l2">
                        <p></p>
                    </div>
                    <div class="w3-col s12 m8 l8">
                        <div class="w3-row meraki-font-s6">

                            <div class="w3-row w3-margin-top">
                                <div class="w3-col m5 l5">
                                    <h4>ID Producto</h4>
                                    <input id="reg-documentos-InputID" class="w3-input w3-border w3-round-medium" type="text" name="ID_regdocumentos" placeholder="ID" disabled>
                                    <input id="regdocumentos-InputID_form" class="w3-input w3-border w3-round-medium" type="text" name="ID_regdocumentos_form" placeholder="ID" style="display:none;">
                                </div>
                                <div class="w3-col m1 l1">
                                    <p></p>
                                </div>
                                <div class="w3-col m6 l6">
                                    <h4>Fecha</h4>
                                    <input id="regdocumentos-InputFecha" class="w3-input w3-border w3-round-medium" type="date" name="fecha_regdocumentos" ng-model="fecha" placeholder="Nombres" required>
                                </div>
                            </div>
                            <hr>


                            <h4>Detalle</h4>
                            <input id="regdocumentos-InputDetalle" class="w3-input w3-border w3-round-medium" type="text" name="detalle_regdocumentos" ng-model="detalle" placeholder="Descripción del movimiento">

                            <hr>
                            <div class="w3-row">
                                <div class="w3-col m2 l2">
                                    <h4>Documento</h4>
                                </div>
                                <div class="w3-col m1 l1">
                                    <p></p>
                                </div>
                                <div class="w3-col m5 l5">
                                    <select id="regdocumentos-InputDocumento" class="w3-select w3-round-medium" name="documento_regdocumentos" title="Lista de Documentos" ng-model="regdocumentos_documento" ng-init="regdocumentos_documento = ''"
                                    ng-mouseleave="setDocTipo()"
                                    ng-mousedown="updateDocumentosTable()">
                                      <option value="" disabled selected>Seleccione</option>
                                      <option ng-repeat = "doc in data_documentos" value="{{doc.Nombre}}">{{doc.Nombre}}</option>
                                  </select>
                                </div>
                                <div class="w3-col m1 l1">
                                    <p></p>
                                </div>
                                <div class="w3-col m3 l3">
                                    <input class="w3-input w3-border w3-round-medium" type="text" name="docnum_regdocumentos" ng-model="docNum" placeholder="N° Documento" value="">
                                </div>
                            </div>
                            <div class="w3-row" style="display: none;">

                                <div class="w3-col m4 l4" ng-repeat="doc in data_documentos | filter:regdocumentos_documento">
                                    <input id="regdocumentos-InputDocTipo" class="w3-input w3-center w3-rightbar w3-leftbar" type="text" placeholder="Tipo = {{ doc.Tipo}}" value="{{ doc.Tipo}}" ng-if="regdocumentos_documento !== ''" disabled>
                                </div>
                                <div class="w3-col m4 l4" ng-repeat="doc in data_documentos | filter:regdocumentos_documento">
                                    <input id="regdocumentos-InputDocNat" class="w3-input w3-center w3-rightbar w3-leftbar" type="text" value="{{doc.Naturaleza}}" placeholder="Naturaleza = {{ doc.Naturaleza}}" ng-if="regdocumentos_documento !== ''" disabled>
                                </div>
                                <div class="w3-col m4 l4" ng-repeat="doc in data_documentos | filter:regdocumentos_documento">
                                    <input id="regdocumentos-InputIDDocumento" class="w3-input w3-center w3-rightbar w3-leftbar" type="text" name="iddocumento_regdocumentos" placeholder="ID = {{ doc.ID}}" ng-if="regdocumentos_documento !== ''" disabled>
                                </div>

                            </div>
                            <div class="w3-row">
                                <div class="w3-col m9 l9">
                                    <p></p>
                                </div>
                                <div class="w3-col m3 l3">
                                    <input class="w3-input w3-border w3-round-medium" type="text" name="guia_regdocumentos" ng-model="guia" placeholder="N° Guía" value="">
                                </div>
                            </div>
                            <hr>
                            <div class="w3-row">
                                <div class="w3-col m2 l2">
                                    <h4>Tercero</h4>
                                </div>
                                <div class="w3-col m1 l1">
                                    <p></p>
                                </div>
                                <div class="w3-col m5 l5">
                                    <select id="regdocumentos-InputTercero" class="w3-select w3-round-medium" name="tercero_regdocumentos" title="Aquí se mostraran los terceros correspondientes al tipo de documentos seleccionado" ng-model="regdocumentos_tercero" ng-init="regdocumentos_tercero = ''"
                                    ng-mousedown="updateTercerosTable()">
                                        <option value="" disabled selected>Seleccione</option>
                                        <option ng-repeat = "ter in data_terceros" value="{{ter.Nombre}}" ng-if="ter.TerceroClass == (docTipo | uppercase)">{{ter.Nombre}}</option>
                                    </select>
                                </div>
                                <div class="w3-col m1 l1">
                                    <p></p>
                                </div>
                                <div class="w3-col m3 l3">
                                    <p></p>
                                </div>
                            </div>
                            <div class="w3-row" style="display: none;">
                                <div class="w3-col m4 l4" ng-repeat="ter in data_terceros | filter:regdocumentos_tercero">
                                    <input class="w3-input w3-center w3-rightbar w3-leftbar" type="text" placeholder="Tipo = {{ter.TerceroClass}}" ng-if="regdocumentos_tercero !== ''" disabled>
                                </div>
                                <div class="w3-col m4 l4" ng-repeat="ter in data_terceros | filter:regdocumentos_tercero">
                                    <input class="w3-input w3-center w3-rightbar w3-leftbar" type="text" placeholder="{{ter.IdentiClass}} = {{ter.Identi}}" ng-if="regdocumentos_tercero !== ''" disabled>
                                </div>
                                <div class="w3-col m4 l4" ng-repeat="ter in data_terceros | filter:regdocumentos_tercero">
                                    <input class="w3-input w3-center w3-rightbar w3-leftbar" type="text" placeholder="ID = {{ter.ID}}" ng-if="regdocumentos_tercero !== ''" disabled>
                                </div>
                            </div>
                            <hr>

                            <div class="w3-row w3-margin-top">
                                <div class="w3-col m2 l2">
                                    <h4>Producto</h4>
                                </div>
                                <div class="w3-col m1 l1">
                                    <p></p>
                                </div>
                                <div class="w3-col m5 l5">
                                    <h4 class="w3-brown w3-border w3-border-black w3-round-large w3-center">{{product}}</h4>
                                </div>
                                <div class="w3-col m1 l1">
                                    <p></p>
                                </div>
                                <div class="w3-col m3 l3">
                                    <input class="w3-input w3-border w3-round-medium" type="text" placeholder="ID = {{productId}}" disabled>
                                </div>
                            </div>
                            <hr class="w3-border w3-border-red">
                            <input class="meraki-search w3-input w3-animate-input w3-light-grey w3-round-medium w3-margin-top" type="text"  ng-model="regdocumentos_prod_filter" placeholder="filtrar productos" style="width:50%">
                        </div>
                    </div>
                    <div class="w3-col s0 m2 l2">
                        <p></p>
                    </div>
                </div>

                <!--PRIMERA TABLA-->
                <div class="w3-container w3-margin-top w3-margin-bottom w3-responsive">
                    <h4>Lista de Productos</h4>
                    <table class="w3-table-all w3-card-4 w3-text-dark-grey">
                        <tr>
                            <th ng-click="orderByMe('ID')">ID</th>
                            <th ng-click="orderByMe('Grupo')">Grupo</th>
                            <th ng-click="orderByMe('Zona')">Zona</th>
                            <th ng-click="orderByMe('Nombre')">Nombre</th>
                            <th ng-click="orderByMe('Unidad')">Unidad Medida</th>
                            <th ng-click="orderByMe('Stock')">Stock</th>
                        </tr>
                        <tr class="prodList-table w3-hover-blue-gray" ng-repeat="x in data_productos | orderBy:myOrderBy | filter:regdocumentos_prod_filter" ng-click="showPrice($event,x.ID)" onclick="activeLink(event, 'prodList-table')">
                            <td>{{ x.ID }}</td>
                            <td>{{ x.Grupo }}</td>
                            <td>{{ x.Zona }}</td>
                            <td>{{ x.Nombre }}</td>
                            <td>{{ x.Unidad }}</td>
                            <td>{{ x.Stock }}</td>
                            <td style="display:none">{{ x.Venta }}</td>
                            <td style="display:none">{{ x.Moneda }}</td>
                            <td style="display:none">{{ x.Compra }}</td>
                        </tr>
                    </table>
                </div>

                <div class="w3-row w3-margin-top">
                    <div class="w3-col s0 m2 l2">
                        <p></p>
                    </div>
                    <div class="w3-col s0 m8 l8">
                        <div class="w3-row-padding w3-center">
                            <div class="w3-col m6 l3">
                                <h4 class="meraki-font-s6 meraki-border-bottom">CANTIDAD</h4>
                            </div>
                            <div class="w3-col m6 l2">
                                <input id="regdocumentos-InputCantidad"class="w3-input w3-xlarge w3-text-bold w3-round-medium" ng-model="cantidad" type="number">
                            </div>
                            <div class="w3-col m0 l1">
                                <p></p>
                            </div>
                            <div class="w3-col m6 l3">
                                <h4 class="meraki-font-s6 meraki-border-bottom">PRECIO DE {{priceText}}</h4>
                            </div>
                            <div class="w3-col m6 l3">
                                <input class="w3-input w3-ana-508 w3-xlarge w3-text-bold w3-round-medium" type="text" name="" value="{{price + ' ' + moneda}}" disabled>
                            </div>
                        </div>

                        <div class="w3-row-padding w3-center w3-margin-top">
                            <div class="w3-col m6 l6">
                                <p></p>
                            </div>
                            <div class="w3-col m3 l3">
                                <button class="w3-btn w3-block w3-ana-502 meraki-border-bottom w3-round-medium" type="button" name="button" ng-click="collectData()" >Agregar</button>
                            </div>
                            <div class="w3-col m3 l3">
                                <button class="w3-btn w3-block w3-ana-502 meraki-border-bottom w3-round-medium" type="button" name="button" ng-click="deleteLast()">Borrar</button>
                            </div>
                        </div>
                        <hr class="w3-border w3-border-red">
                        <input class="meraki-search w3-input w3-animate-input w3-light-grey w3-round-medium w3-margin-top" type="text"  ng-model="regdocumentos_resumen_filter" placeholder="filtrar resumen" style="width:50%">
                    </div>
                    <div class="w3-col s0 m2 l2">
                        <p></p>
                    </div>
                </div>

                <!--SEGUNDA TABLA-->
                <div class="w3-container w3-margin-top w3-margin-bottom w3-responsive">

                    <h4>Resumen de {{priceText}}</h4>
                    <table class="w3-table-all w3-card-4 w3-text-dark-grey">
                        <tr>
                            <th>ID</th>
                            <th>Fecha</th>
                            <th>Doc.</th>
                            <th>N°Doc</th>
                            <th>N°Guía</th>
                            <th>Tercero</th>
                            <th>Detalle</th>
                            <th>ID Prod.</th>
                            <th>Prod.</th>
                            <th>Moneda</th>
                            <th>(E)Cantidad</th>
                            <th>(E)P.Unitario</th>
                            <th>(E)Total</th>
                            <th>(S)Cantidad</th>
                            <th>(S)P.Unitario</th>
                            <th>(S)Total</th>
                            <th>Stock</th>
                        </tr>
                        <tr class="resumen-table w3-hover-blue-gray" ng-repeat="x in DataCollected | filter:regdocumentos_resumen_filter" onclick="activeLink(event, 'resumen-table')">
                            <td>{{ $index + 1 }}</td>
                            <td>{{ x.Fecha }}</td>
                            <td>{{ x.Doc }}</td>
                            <td>{{ x.Docnum }}</td>
                            <td>{{ x.Guia }}</td>
                            <td>{{ x.Tercero }}</td>
                            <td>{{ x.Detalle }}</td>
                            <td>{{ x.IDProd }}</td>
                            <td>{{ x.Prod }}</td>
                            <td>{{ x.Moneda}}</td>
                            <td>{{ x.ECantidad }}</td>
                            <td>{{ x.EPUnitario }}</td>
                            <td>{{ x.ETotal }}</td>
                            <td>{{ x.SCantidad }}</td>
                            <td>{{ x.SPUnitario }}</td>
                            <td>{{ x.STotal }}</td>
                            <td>{{ DataCollected[$index].Stock }}</td>
                        </tr>
                    </table>
                </div>

                <div class="w3-row w3-margin-top">
                    <div class="w3-col s0 m2 l2">
                        <p></p>
                    </div>
                    <div class="w3-col s0 m8 l8">
                        <div class="w3-row-padding w3-center w3-margin-top">
                            <div class="w3-col m6 l6">
                                <p></p>
                            </div>
                            <div class="w3-col m3 l3">
                                <button class="w3-btn w3-block w3-ana-502 meraki-border-bottom w3-round-medium" type="button" name="button" ng-click="deleteAll()">Limpiar</button>
                            </div>
                            <div class="w3-col m3 l3">
                                <button class="w3-btn w3-block w3-ana-502 meraki-border-bottom w3-round-medium" type="button" name="button" ng-click="save()" ng-mouseleave="updateProductosTable()">Registrar</button>
                            </div>
                        </div>
                    </div>
                    <div class="w3-col s0 m2 l2">
                        <p></p>
                    </div>
                </div>



                <div style="height:50vh;">
                    <p></p>
                </div>

            </div>

            <!--************ EDITAR/ELIMINAR MOVIMIENTOS ***************-->
            <div id="edit-documentos" class="cardexBlock w3-container w3-padding w3-animate-right" ng-controller="editdocumentos-Ctrl" style="display: none; margin-top: 75px;">
                <div class="w3-container w3-ana-509 w3-card-4 w3-round-medium">
                    <h4 class="meraki-font-s6">Editar/Eliminar Documentos</h4>
                </div>

                <div class="w3-container w3-margin-top meraki-font-s6">
                    <input class="meraki-search w3-input w3-animate-input w3-light-grey w3-round-medium" type="text"  ng-model="editdocumentos_filter" style="width:30%" placeholder="filtrar contenido">
                    <p></p>
                    <button class="w3-btn w3-ana-502 meraki-border-bottom w3-margin-right w3-round-medium" type="button" ng-click="exportData_editdocumentos()">Export</button>
                    <button class="w3-btn w3-ana-502 meraki-border-bottom w3-margin-right w3-round-medium" type="button" ng-click="editEnabler()"><i class="fa fa-pencil fa-fw" aria-hidden="true"></i> Editar</button>
                    <button class="w3-btn w3-ana-502 meraki-border-bottom w3-margin-right w3-round-medium" type="button" ng-click="saveReg()"><i class="fa fa-save fa-fw" aria-hidden="true"></i> Guardar</button>
                </div>
                <hr class="w3-border w3-border-red">

                <div class="w3-container w3-margin-bottom w3-responsive meraki-font-s6" style="height: 80%;">

                    <h4>Resumen</h4>
                    <table class="w3-table-all w3-card-4 w3-text-dark-grey">
                        <thead class="w3-small">
                            <tr>
                                <th class="w3-border-right w3-border-gray">Operación</th>
                                <th>ID</th>
                                <th>Fecha</th>
                                <th>Doc.</th>
                                <th>N°Doc</th>
                                <th class="w3-border-right w3-border-gray">N°Guía</th>
                                <th>Tercero</th>
                                <th>Detalle</th>
                                <th>ID Prod.</th>
                                <th>Prod.</th>
                                <th class="w3-border-right w3-border-gray">Moneda</th>
                                <th>(E)Cantidad</th>
                                <th>(E)P.Unitario</th>
                                <th>(E)Total</th>
                                <th>(S)Cantidad</th>
                                <th>(S)P.Unitario</th>
                                <th class="w3-border-right w3-border-gray">(S)Total</th>
                                <th>Stock</th>
                            </tr>
                        </thead>

                        <tbody class="w3-small meraki-font-s5">
                            <tr ng-click="getIndexToSave($index)" ng-repeat="x in data_editdocumentos | filter:editdocumentos_filter" ng-if="x.Operacion > 0">
                                <td class="w3-border-right w3-border-gray">{{ x.Operacion }}</td>
                                <td>{{ x.ID }}</td>
                                <td>{{ x.Fecha }}</td>
                                <td><input type="text" value="{{ x.Doc }}" ng-disabled="editEnable"></td>
                                <td class="w3-border-right w3-border-gray"><input type="text" value="{{ x.DocNum }}" style="width:100%;" ng-disabled="editEnable"></td>
                                <td class="w3-border-right w3-border-gray"><input type="text" value="{{ x.Guia }}" style="width:100%;" ng-disabled="editEnable"></td>
                                <td><input type="text" value="{{ x.Tercero }}" ng-disabled="editEnable"></td>
                                <td><input type="text" value="{{ x.Detalle }}" ng-disabled="editEnable"></td>
                                <td><input type="text" value="{{ x.IDProd }}" style="width:100%;" ng-disabled="editEnable"></td>
                                <td><input type="text" value="{{ x.Prod }}" style="width:100%;" ng-disabled="editEnable"></td>
                                <td class="w3-border-right w3-border-gray"><input type="text" value="{{ x.Moneda}}" style="width:100%;" ng-disabled="editEnable"></td>
                                <td><input type="text" value="{{ x.ECantidad }}" style="width:100%;" ng-disabled="editEnable"></td>
                                <td><input type="text" value="{{ x.EPUnitario }}" style="width:100%;" ng-disabled="editEnable"></td>
                                <td><input type="text" value="{{ x.ETotal }}" style="width:100%;" ng-disabled="editEnable"></td>
                                <td><input type="text" value="{{ x.SCantidad }}" style="width:100%;" ng-disabled="editEnable"></td>
                                <td><input type="text" value="{{ x.SPUnitario }}" style="width:100%;" ng-disabled="editEnable"></td>
                                <td class="w3-border-right w3-border-gray"><input type="text" value="{{ x.STotal }}" style="width:100%;" ng-disabled="editEnable"></td>
                                <td class="w3-border-right w3-border-gray"><input type="text" value="{{ x.Stock }}" style="width:100%;" ng-disabled="editEnable"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="w3-container" style="height:50vh;">
                    <p></p>
                </div>
            </div>

            <!--************ CARDEX ***************-->
            <div id="consultas" class="cardexBlock w3-container w3-padding w3-animate-right" ng-controller="consultas-Ctrl" style="display: none; margin-top: 75px;">
                <div class="w3-container w3-ana-509 w3-card-4">
                    <h4 class="meraki-font-s6">Cardex</h4>
                </div>

                <div id="consultas-div" class="w3-container meraki-font-s6">
                    <div class="w3-row-padding w3-margin-top w3-margin-bottom">
                        <div class="w3-half">
                            <label>Fecha inicial:</label>
                            <input ng-model="fechaIni" class="w3-input w3-border" id="consultas_InputFechai" type="date"/>
                        </div>
                        <div class="w3-half">
                            <label>Fecha final:</label>
                            <input ng-model="fechaFin" class="w3-input w3-border" id="consultas_InputFechaf" type="date"/>
                        </div>
                    </div>

                    <!--fieldset>
                        <legend>Criterios del documento:</legend>
                        <div class="w3-row-padding">
                            <div class="w3-third">
                                <input ng-model="docCriteria" class="w3-radio" name="consultas_RadioDoc" type="radio" ng-value="false">
                                <label> Ver todos los documentos</label>
                            </div>
                            <div class="w3-third">
                                <input ng-model="docCriteria" class="w3-radio" name="consultas_RadioDoc" type="radio" ng-value="true">
                                <label> Seleccione el documento : </label>
                                <select ng-model="docCriteria_nombre" class="w3-margin-top w3-select" name="tipo">
                                    <option value="" selected disabled>Documento</option>
                                    <option ng-repeat="x in data_documentos" value="{{x.Nombre}}">{{x.Nombre}}</option>
                                </select>
                            </div>
                        </div>


                    </fieldset>

                    <fieldset>
                        <legend>Criterios para los terceros:</legend>
                        <div class="w3-row-padding">
                            <div class="w3-third">
                                <input ng-model="terCriteria" class="w3-radio" name="consultas_RadioTer" type="radio" ng-value="1">
                                <label> Ver todos los terceros </label>
                            </div>
                            <div class="w3-third">
                                <input ng-model="terCriteria" class="w3-radio" name="consultas_RadioTer" type="radio" ng-value="2">
                                <label> Seleccione tercero </label>
                                <select ng-model="terCriteria_nombre" class="w3-margin-top w3-select" >
                                    <option value="" selected disabled>Tercero</option>
                                    <option ng-repeat="x in data_terceros" value="{{x.Nombre}}">{{x.Nombre}}</option>
                                </select>
                            </div>
                            <div class="w3-third">
                                <input ng-model="terCriteria" class="w3-radio" name="consultas_RadioTer" type="radio" ng-value="3">
                                <label>Filtrar terceros </label>
                                <select ng-model="terCriteria_tipo" class="w3-margin-top w3-select">
                                    <option value="" selected disabled>Tipo</option>
                                    <option ng-repeat="x in data_terceros"  value="{{x.TerceroClass}}">{{x.TerceroClass}}</option>
                                </select>

                                <select ng-model="terCriteria_ciudad" class="w3-margin-top w3-select">
                                    <option value="" selected disabled>Ciudad</option>
                                    <option ng-repeat="x in data_terceros | unique: 'Ciudad'" value="{{x.Ciudad}}">{{x.Ciudad}}</option>
                                </select>
                            </div>
                        </div>


                    </fieldset-->

                    <fieldset>
                        <legend>Criterios para productos:</legend>
                        <div class="w3-row-padding">
                            <div class="w3-third">
                                <input ng-model="prodCriteria" class="w3-radio" name="consultas_RadioProd" type="radio" ng-value="1">
                                <label for="radio">Ver todos los productos </label>
                            </div>
                            <div class="w3-third">
                                <input ng-model="prodCriteria" class="w3-radio" name="consultas_RadioProd" type="radio" ng-value="2">
                                <label for="radio"> Seleccione el producto:</label>
                                <select ng-model="prodCriteria_nombre" class="w3-select w3-margin-top">
                                    <option value="" selected disabled>Producto</option>
                                    <option ng-repeat="x in data_productos | unique: 'Nombre'" value="{{x.Nombre}}">{{x.Nombre}}</option>
                                </select>
                            </div>
                            <!--div class="w3-third">
                                <input ng-model="prodCriteria" class="w3-radio" name="radio" type="radio" ng-value="3">
                                <label>Filtrar productos </label>
                                <select class="w3-select w3-margin-top">
                                    <option value="" selected disabled>Grupo</option>
                                    <option ng-repeat="x in data_productos | unique: 'Grupo'" value="{{x.Grupo}}">{{x.Grupo}}</option>
                                </select>
                                <select class="w3-select w3-margin-top">
                                    <option value="" selected disabled>Zona</option>
                                    <option ng-repeat="x in data_productos | unique: 'Zona'" value="{{x.Zona}}">{{x.Zona}}</option>
                                </select>
                                <select class="w3-select w3-margin-top">
                                    <option value="" selected disabled>Unidad</option>
                                    <option ng-repeat="x in data_productos | unique: 'Unidad'" value="{{x.Unidad}}">{{x.Unidad}}</option>
                                </select>
                                <select class="w3-select w3-margin-top">
                                    <option value="" selected disabled>Detalles</option>
                                    <option ng-repeat="x in data_productos | unique: 'Detalles'" value="{{x.Detalles}}">{{x.Detalles}}</option>
                                </select>
                            </div-->
                        </div>
                    </fieldset>
                </div>

                <p></p>
                <div class="w3-container w3-center meraki-font-s6">
                    <button ng-click="generateQuery(); toggleTable()" class="w3-btn w3-ana-502 meraki-border-bottom w3-left w3-margin-right" type="button" > Generar Consulta</button>
                    <button class="w3-btn w3-ana-502 meraki-border-bottom w3-left w3-margin-right" type="button" onclick = "w3.toggleShow('#consultas-div')"> Toggle</button>
                    <button ng-click="exportData_consultas()" class="w3-btn w3-ana-502 meraki-border-bottom w3-left" type="button" > Exportar</button>
                </div>

                <div ng-show="showTableConsultas" class="w3-section w3-margin-bottom w3-responsive meraki-font-s6" style="height: 80%;">

                    <h4>Resumen</h4>
                    <table class="w3-table-all w3-card-4 w3-text-dark-grey">
                        <thead class="w3-small">
                            <tr>
                                <th class="w3-border-right w3-border-gray">Operación</th>
                                <th>Item</th>
                                <th>Fecha</th>
                                <th>Doc.</th>
                                <th>N°Doc</th>
                                <th class="w3-border-right w3-border-gray">N°Guía</th>
                                <th>Tercero</th>
                                <th>Detalle</th>
                                <th>ID Prod.</th>
                                <th>Prod.</th>
                                <th class="w3-border-right w3-border-gray">Moneda</th>
                                <th>(E)Cantidad</th>
                                <th>(E)P.Unitario</th>
                                <th>(E)Total</th>
                                <th>(S)Cantidad</th>
                                <th>(S)P.Unitario</th>
                                <th class="w3-border-right w3-border-gray">(S)Total</th>
                                <th>Stock</th>
                            </tr>
                        </thead>

                        <tbody class="w3-small meraki-font-s5">
                            <tr ng-repeat="x in data_query" ng-if="x.Operacion > 0">
                                <td class="w3-border-right w3-border-gray">{{ x.Operacion }}</td>
                                <td>{{ x.ID }}</td>
                                <td>{{ x.Fecha }}</td>
                                <td>{{ x.Doc }}</td>
                                <td>{{ x.DocNum }}</td>
                                <td class="w3-border-right w3-border-gray">{{ x.Guia }}</td>
                                <td>{{ x.Tercero }}</td>
                                <td>{{ x.Detalle }}</td>
                                <td>{{ x.IDProd }}</td>
                                <td>{{ x.Prod }}</td>
                                <td class="w3-border-right w3-border-gray">{{ x.Moneda}}</td>
                                <td>{{ x.ECantidad }}</td>
                                <td>{{ x.EPUnitario }}</td>
                                <td>{{ x.ETotal }}</td>
                                <td>{{ x.SCantidad }}</td>
                                <td>{{ x.SPUnitario }}</td>
                                <td class="w3-border-right w3-border-gray">{{ x.STotal }}</td>
                                <td>{{ x.Stock }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="w3-section" style="height:50vh;">

                </div>
            </div>

            <!--************ INFORMES ***************-->
            <div id="informes" class="cardexBlock w3-container w3-padding w3-animate-right" ng-controller="ZSCtrl" style="display: none;margin-top: 75px;">
                <div class="w3-container w3-ana-509 w3-card-4">
                    <h4>Informes</h4>
                </div>

                <form action="" method="post">
                    <h3>Fecha de Búsqueda</h3>
                    <p><input id="informes-InputDateSearch" class="w3-date" type="date" /></p>

                    <h3>Tipo de Contenido en Informe</h3>
                    <input id="informes-InputResumen" name="informes_RadioTipo" class="w3-radio" type="radio" value="resumen" /> <label>Resumen </label>
                    <input id="informes-InputDetallesMovimientos" name="informes_RadioTipo" class="w3-radio" type="radio" /> <label> Detalle de movimientos</label>
                    <p></p>

                    <h3>Informes de Stock</h3>
                    <div class="w3-row-padding">
                        <div class="w3-half">
                            <button class="w3-btn w3-block w3-ana-502 meraki-border-bottom w3-margin-bottom" type="button">STOCK General</button>
                            <button class="w3-btn w3-block w3-ana-502 meraki-border-bottom w3-margin-bottom" type="button">STOCK Zona</button>
                            <button class="w3-btn w3-block w3-ana-502 meraki-border-bottom w3-margin-bottom" type="button">STOCK Según Grupo</button>
                            <button class="w3-btn w3-block w3-ana-502 meraki-border-bottom w3-margin-bottom" type="button">STOCK Alerta y Emergencia</button>
                        </div>
                        <div class="w3-half">
                            <button class="w3-btn w3-block w3-ana-502 meraki-border-bottom w3-margin-bottom" type="button">STOCK Auditoria</button>
                            <button class="w3-btn w3-block w3-ana-502 meraki-border-bottom w3-margin-bottom" type="button">STOCK Semáforo Salidas</button>
                            <button class="w3-btn w3-block w3-ana-502 meraki-border-bottom w3-margin-bottom" type="button">STOCK Semáforo Entradas</button>
                            <button class="w3-btn w3-block w3-ana-502 meraki-border-bottom w3-margin-bottom" type="button">STOCK Semáforo Salidas</button>
                        </div>
                    </div>

                    <h3>Informes de Frecuencia</h3>
                    <button class="w3-btn w3-block w3-ana-502 meraki-border-bottom w3-margin-bottom " type="button">STOCK movimientos</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        var app = angular.module('ZSApp', []);
        app.filter('unique', function() {
           return function(collection, keyname) {
              var output = [],
                  keys = [];

              angular.forEach(collection, function(item) {
                  var key = item[keyname];
                  if(keys.indexOf(key) === -1) {
                      keys.push(key);
                      output.push(item);
                  }
              });
              return output;
           };
        });
        app.controller('ZSCtrl', function($scope, $http) {
            $scope.data_zonasSucursales = [];
            $http.get("../php/ZS_mysql.php").then(function(response) {
                $scope.data_zonasSucursales = response.data.records;
            });

            $scope.updateZSTable = function() {
                $http.get("../php/ZS_mysql.php").then(function(response) {
                    $scope.data_zonasSucursales = response.data.records;
                });
            }

            $scope.exportData_zonasSucursales = function (){
                alasql('SELECT * INTO XLSX("Zonas_Sucursales.xlsx",{headers:true}) FROM ?',[$scope.data_zonasSucursales]);
            }

            $scope.orderByMe = function(x) {
                $scope.myOrderBy = x;
            }
        });
        app.controller('grupos-Ctrl', function($scope, $http, $window) {
            $scope.data_grupos = [];
            $http.get("../php/grupos_mysql.php").then(function(response) {
                $scope.data_grupos = response.data.records;
            });

            $scope.updateGruposTable = function() {
                $http.get("../php/grupos_mysql.php").then(function(response) {
                    $scope.data_grupos = response.data.records;
                });
            }

            $scope.exportData_grupos = function (){
                alasql('SELECT * INTO XLSX("grupos.xlsx",{headers:true}) FROM ?',[$scope.data_grupos]);
            }

            $scope.orderByMe = function(x) {
                $scope.myOrderBy = x;
            }
        });
        app.controller('documentos-Ctrl', function($scope, $http, $window) {
            $scope.data_documentos = [];
            $http.get("../php/documentos_mysql.php").then(function(response) {
                $scope.data_documentos = response.data.records;
            });

            $scope.updateDocumentosTable = function() {
                $http.get("../php/documentos_mysql.php").then(function(response) {
                    $scope.data_documentos = response.data.records;
                });
            }

            $scope.exportData_documentos = function (){
                alasql('SELECT * INTO XLSX("documentos.xlsx",{headers:true}) FROM ?',[$scope.data_documentos]);
            }

            $scope.orderByMe = function(x) {
                $scope.myOrderBy = x;
            }
        });
        app.controller('terceros-Ctrl', function($scope, $http, $window) {
            $scope.data_terceros = [];
            $http.get("../php/terceros_mysql.php").then(function(response) {
                $scope.data_terceros = response.data.records;
            });

            $scope.updateTercerosTable = function() {
                $http.get("../php/terceros_mysql.php").then(function(response) {
                    $scope.data_terceros = response.data.records;
                });
            }

            $scope.exportData_terceros = function (){
                alasql('SELECT * INTO XLSX("terceros.xlsx",{headers:true}) FROM ?',[$scope.data_terceros]);
            }

            $scope.orderByMe = function(x) {
                $scope.myOrderBy = x;
            }
        });
        app.controller('productos-Ctrl', function($scope, $controller, $http) {
            $scope.data_productos = [];
            $scope.grupo_seleccionado = '';
            $scope.stock = 0;
            $scope.stocke = 0;
            $scope.stocka_offset = 100;

            $http.get("../php/productos_mysql.php").then(function(response) {
                $scope.data_productos = response.data.records;

            });

            $scope.updateProductosTable = function() {
                $http.get("../php/productos_mysql.php").then(function(response) {
                    $scope.data_productos = response.data.records;

                });
            }

            $scope.exportData_productos = function (){
                alasql('SELECT * INTO XLSX("productos.xlsx",{headers:true}) FROM ?',[$scope.data_productos]);
            }

            $scope.orderByMe = function(x) {
                $scope.myOrderBy = x;
            }

            $scope.Add = function() {

                var stocke_value = Number($scope.stocke || 0);
                $scope.stocka = stocke_value + (stocke_value * ($scope.stocka_offset/100.0));

            }

            angular.extend(this, $controller('ZSCtrl', {
                $scope: $scope
            }));
            angular.extend(this, $controller('grupos-Ctrl', {
                $scope: $scope
            }));
        });
        app.controller('regdocumentos-Ctrl', function($scope, $controller, $http, $templateCache, $filter) {
            $scope.grupo_seleccionado = '';
            $scope.regdocumentos_documento = '';
            $scope.regdocumentos_tercero = '';
            $scope.price = 0;
            $scope.fecha = '';
            $scope.detalle = '';
            $scope.moneda = '';
            $scope.product = 'Seleccione un producto';
            $scope.productId = '';
            $scope.stock = '';
            $scope.temp_stock = [];
            $scope.guia = '';
            $scope.docNum = '';
            $scope.docNat = '';
            $scope.docTipo = '';
            $scope.compra = '';
            $scope.venta = 0;
            $scope.priceText = '...';
            $scope.cantidad = 0;
            $scope.DataCollected = [];
            $scope.workProdIndex = -1;
            var collect = true;

            $scope.orderByMe = function(x) {
                $scope.myOrderBy = x;
            }

            $scope.showPrice = function(myE, prodID) {
                var row = angular.element(myE.currentTarget);
                $scope.venta = row[0].cells[6].innerHTML;
                $scope.product = row[0].cells[3].innerHTML;
                $scope.stock = row[0].cells[5].innerHTML;
                $scope.productId = row[0].cells[0].innerHTML;
                $scope.moneda = row[0].cells[7].innerHTML;
                $scope.compra = row[0].cells[8].innerHTML;
                $scope.setDocTipo();
                // alert('prodID: ' + prodID);
                if (prodID !== $scope.workProdIndex) {

                    $scope.workProdIndex = prodID;
                    // alert('outside' + ' ' + $scope.temp_stock);
                    if ($scope.temp_stock.length === 0) {
                        $scope.temp_stock.push({"index":$scope.workProdIndex,"stock":0});
                        $scope.workProdIndex = 1;
                        //alert('inside' + ' ' + $scope.temp_stock[0].stock);
                    }else {
                        var already = false;
                        for (var i = 0; i < $scope.temp_stock.length; i++) {
                            if ($scope.temp_stock[i].index === prodID) {
                                already = true;
                                $scope.workProdIndex = i + 1;
                            }
                        }
                        if (!already) {
                            // alert('item added');
                            $scope.temp_stock.push({"index":$scope.workProdIndex,"stock":0});
                        }
                    }

                }

            }

            $scope.setDocTipo = function(){

                var docTipo = angular.element(document.querySelector('#regdocumentos-InputDocTipo'));
                var docNat = angular.element(document.querySelector('#regdocumentos-InputDocNat'));

                if (docTipo[0] !== undefined) {
                    $scope.docTipo = docTipo[0].value;
                    $scope.docNat = docNat[0].value;

                    if ($scope.docNat === 'entrada') {
                        $scope.priceText = 'COMPRA';
                        $scope.price = $scope.compra;
                    }else if ($scope.docNat === 'salida') {
                        $scope.priceText = 'VENTA';
                        $scope.price = $scope.venta;
                    }else {
                        $scope.priceText = 'AJUSTE';
                        $scope.price = '0';
                    }
                }
            }

            $scope.collectData = function(){
                if ($scope.fecha === '') {
                    alert('Fecha no seleccionada');
                    collect = false;
                    return;
                }else {
                    collect = true;
                }

                if ($scope.detalle === '') {
                    collect = confirm('Continuar sin detalle ?');
                    if (!collect) {
                        return;
                    }
                }

                if ($scope.regdocumentos_documento === '') {
                    alert('Documento no seleccionado');
                    collect = false;
                    return;
                }else {
                    collect = true;
                }

                if ($scope.docNum === '') {
                    collect = confirm('Continuar sin número de documento ?');
                    if (!collect) {
                        return;
                    }
                }

                if ($scope.guia === '') {
                    collect = confirm('Continuar sin número de guía ?');
                    if (!collect) {
                        return;
                    }
                }

                if ($scope.regdocumentos_tercero === '') {
                    alert('Tercero no seleccionado');
                    collect = false;
                    return;
                }else {
                    collect = true;
                }

                if ($scope.product === '') {
                    alert('Producto no seleccionado');
                    collect = false;
                    return;
                }else {
                    collect = true;
                }

                if ($scope.cantidad === 0) {
                    alert('Cantidad no asignada');
                    collect = false;
                    return;
                }

                if (collect) {

                    $scope.fecha = $filter('date')($scope.fecha, 'y-MM-dd');
                    //alert('workIndex: ' + $scope.workProdIndex);

                    if ($scope.docNat === 'salida') {
                        if ($scope.temp_stock[$scope.workProdIndex - 1].stock === 0) {
                            if ($scope.cantidad < $scope.stock) {
                                $scope.temp_stock[$scope.workProdIndex - 1].stock = Number($scope.stock || 0) - $scope.cantidad;
                            }else{
                                alert('Stock actual superado');
                                return;
                            }

                        }else {
                            if ($scope.cantidad < $scope.temp_stock[$scope.workProdIndex - 1].stock) {
                                $scope.temp_stock[$scope.workProdIndex - 1].stock = $scope.temp_stock[$scope.workProdIndex - 1].stock - $scope.cantidad;
                            }else{
                                alert('Stock residual superado');
                                return;
                            }

                        }
                        //alert($scope.temp_stock[$scope.workProdIndex - 1].stock);
                        var tempDataCollected = {"Fecha":$scope.fecha,"Doc":$scope.regdocumentos_documento,"Docnum":$scope.docNum,"Guia":$scope.guia,"Tercero":$scope.regdocumentos_tercero,"Detalle":$scope.detalle,"IDProd":$scope.productId,"Prod":$scope.product,"Moneda":$scope.moneda,"ECantidad":'',"EPUnitario":'',"ETotal":'',"SCantidad":$scope.cantidad,"SPUnitario":$scope.price,"STotal":$scope.price*$scope.cantidad,"Stock":$scope.temp_stock[$scope.workProdIndex - 1].stock};
                    }else if ($scope.docNat === 'entrada') {
                        if ($scope.temp_stock[$scope.workProdIndex - 1].stock === 0) {
                            $scope.temp_stock[$scope.workProdIndex - 1].stock = Number($scope.stock || 0) + $scope.cantidad;
                        }else {
                            $scope.temp_stock[$scope.workProdIndex - 1].stock = $scope.temp_stock[$scope.workProdIndex - 1].stock + $scope.cantidad;
                        }
                        //alert($scope.temp_stock[$scope.workProdIndex - 1].stock);
                        var tempDataCollected = {"Fecha":$scope.fecha,"Doc":$scope.regdocumentos_documento,"Docnum":$scope.docNum,"Guia":$scope.guia,"Tercero":$scope.regdocumentos_tercero,"Detalle":$scope.detalle,"IDProd":$scope.productId,"Prod":$scope.product,"Moneda":$scope.moneda,"ECantidad":$scope.cantidad,"EPUnitario":$scope.price,"ETotal":$scope.price*$scope.cantidad,"SCantidad":'',"SPUnitario":'',"STotal":'',"Stock":$scope.temp_stock[$scope.workProdIndex - 1].stock};
                    }else if ($scope.docNat === 'ajuste') {
                        var tempDataCollected = {"Fecha":$scope.fecha,"Doc":$scope.regdocumentos_documento,"Docnum":$scope.docNum,"Guia":$scope.guia,"Tercero":$scope.regdocumentos_tercero,"Detalle":$scope.detalle,"IDProd":$scope.productId,"Prod":$scope.product,"Moneda":$scope.moneda,"ECantidad":'',"EPUnitario":'',"ETotal":'',"SCantidad":'',"SPUnitario":'',"STotal":'',"Stock":$scope.temp_stock[$scope.workProdIndex - 1].stock};
                    }

                    $scope.DataCollected.push(tempDataCollected);
                }
            }

            $scope.deleteLast = function(){
                if ($scope.DataCollected.length > 0) {
                    if (confirm("Descartar último ingreso a resumen ?")) {

                        if ($scope.docNat === 'salida') {
                            $scope.temp_stock[$scope.workProdIndex - 1].stock = $scope.temp_stock[$scope.workProdIndex - 1].stock + Number($scope.DataCollected[$scope.DataCollected.length -1].SCantidad || 0);
                        }
                        if ($scope.docNat === 'entrada') {
                            $scope.temp_stock[$scope.workProdIndex - 1].stock = $scope.temp_stock[$scope.workProdIndex - 1].stock - Number($scope.DataCollected[$scope.DataCollected.length -1].ECantidad || 0);
                        }

                        $scope.DataCollected.pop();
                    }
                }else{
                    alert("Resumen vacío ...");
                }


            }

            $scope.deleteAll = function(){
                if ($scope.DataCollected.length > 0) {
                    if (confirm("Limpiar resumen ?")) {
                        $scope.DataCollected = [];

                        $scope.temp_stock = [];

                        $scope.workProdIndex = -1;
                    }
                }else{
                    alert("Resumen vacío ...");
                }


            }

            $scope.save = function(){
                if ($scope.DataCollected.length > 0) {
                    if (confirm("Subir resumen ?")) {
                        $http({
                            method: 'POST',
                            url: '../php/regdocumentos-cre.php',
                            cache: $templateCache,
                            data: $scope.DataCollected
                        }).then(function(response){
                            alert(response.data);
                        });

                        $http({
                            method: 'POST',
                            url: '../php/update-stock.php',
                            cache: $templateCache,
                            data: $scope.temp_stock
                        }).then(function(response){
                            $scope.updateProductosTable();
                        });
                    }

                }else{
                    alert("Resumen vacío ...");
                }
            }

            angular.extend(this, $controller('productos-Ctrl', {
                $scope: $scope
            }));
            angular.extend(this, $controller('documentos-Ctrl', {
                $scope: $scope
            }));
            angular.extend(this, $controller('terceros-Ctrl', {
                $scope: $scope
            }));
        });
        app.controller('editdocumentos-Ctrl', function($scope, $http, $window) {
            $scope.data_editdocumentos = [];
            $scope.editEnable = true;
            $scope.indexToSave = 0;

            $http.get("../php/editdocumentos_mysql.php").then(function(response) {
                $scope.data_editdocumentos = response.data.records;
            });

            $scope.updateEditdocumentosTable = function() {
                $http.get("../php/editdocumentos_mysql.php").then(function(response) {
                    $scope.data_editdocumentos = response.data.records;
                });
            }

            $scope.exportData_editdocumentos = function (){
                alasql('SELECT * INTO XLSX("editdocumentos.xlsx",{headers:true}) FROM ?',[$scope.data_editdocumentos]);
            }

            $scope.editEnabler = function () {
                $scope.editEnable = !$scope.editEnable;
            }

            $scope.saveReg = function(){

            }

            $scope.getIndexToSave = function(indice){
                $scope.indexToSave = indice;
            }

            $scope.orderByMe = function(x) {
                $scope.myOrderBy = x;
            }
        });
        app.controller('consultas-Ctrl', function($scope, $controller, $http, $filter) {
            $scope.data_consultas       = [];
            $scope.data_query           = [];
            $scope.fechaIni             = '';
            $scope.fechaFin             = '';
            /**/
            $scope.docCriteria          = false;
            $scope.terCriteria          = 0;
            $scope.prodCriteria         = 0;
            /**/
            $scope.docCriteria_nombre   = '';
            /**/
            $scope.terCriteria_nombre   = '';
            $scope.terCriteria_tipo     = '';
            $scope.terCriteria_ciudad   = '';
            /**/
            $scope.prodCriteria_nombre  = '';
            $scope.prodCriteria_grupo   = '';
            $scope.prodCriteria_zona    = '';
            $scope.prodCriteria_unidad  = '';
            $scope.prodCriteria_detalles= '';
            /**/
            $scope.showTableConsultas   = false;

            $scope.exportData_consultas = function (){
                alasql('SELECT * INTO XLSX("consultas.xlsx",{headers:true}) FROM ?',[$scope.data_query]);
            }

            $scope.generateQuery = function(){

                $http.get("../php/editdocumentos_mysql.php").then(function(response) {
                    $scope.data_consultas = response.data.records;

                    var temp_data_consultas = [];

                    $scope.fechaIni = $filter('date')($scope.fechaIni, 'y-MM-dd');
                    $scope.fechaFin = $filter('date')($scope.fechaFin, 'y-MM-dd');

                    if ($scope.fechaIni !== '' && $scope.fechaFin !== '') {
                        for (var i = 0; i < $scope.data_consultas.length; i++) {
                            if ($scope.data_consultas[i].Fecha >= $scope.fechaIni && $scope.data_consultas[i].Fecha <= $scope.fechaFin) {
                                temp_data_consultas.push($scope.data_consultas[i]);
                            }

                        }
                        $scope.data_consultas = temp_data_consultas;
                    }
                    /*
                    if ($scope.docCriteria === true) {
                        if ($scope.docCriteria_nombre !== null) {
                            $scope.data_consultas = $filter('filter')($scope.data_consultas, $scope.docCriteria_nombre);
                        }
                    }


                    if ($scope.terCriteria === 2) {
                        if ($scope.terCriteria_nombre !== null) {
                            $scope.data_consultas = $filter('filter')($scope.data_consultas, $scope.terCriteria_nombre);
                        }
                    }


                    alert($scope.terCriteria_nombre + ' ' +$scope.terCriteria_tipo +' ' + $scope.terCriteria_tipo + ' ' + $scope.data_consultas.length);
                    if ($scope.terCriteria === 3) {
                        if ($scope.terCriteria_tipo !== null) {
                            $scope.data_consultas = $filter('filter')($scope.data_consultas, $scope.terCriteria_tipo);
                            alert($scope.data_consultas.length);
                        }
                        if ($scope.terCriteria_ciudad !== null) {
                            $scope.data_consultas = $filter('filter')($scope.data_consultas, $scope.terCriteria_ciudad);
                            alert($scope.data_consultas.length);
                        }
                    }*/

                    if ($scope.prodCriteria === 2) {
                        if ($scope.prodCriteria_nombre !== null) {
                            $scope.data_consultas = $filter('filter')($scope.data_consultas, $scope.prodCriteria_nombre);
                        }
                    }
                    $scope.data_query = $scope.data_consultas;
                });
            }

            $scope.toggleTable = function(){
                $scope.showTableConsultas = true;
            }

            angular.extend(this, $controller('regdocumentos-Ctrl', {
                $scope: $scope
            }));
            angular.extend(this, $controller('documentos-Ctrl', {
                $scope: $scope
            }));

            angular.extend(this, $controller('productos-Ctrl', {
                $scope: $scope
            }));
        });


        function w3_open() {

            document.getElementById("main").style.marginLeft = "25%";
            document.getElementById("sidebarMenu").style.width = "25%";
            document.getElementById("sidebarMenu").style.display = "block";

        }

        function w3_open_small() {

            document.getElementById("main").style.marginLeft = "60%";
            document.getElementById("sidebarMenu-small").style.width = "60%";
            document.getElementById("sidebarMenu-small").style.display = "block";

        }

        function w3_close() {
            document.getElementById("main").style.marginLeft = "0%";
            document.getElementById("sidebarMenu").style.display = "none";
            document.getElementById("sidebarMenu-small").style.display = "none";

        }

        function ZS_showCells(owner) {
            document.getElementById("ZSInputID").value = owner.cells[0].innerHTML;
            document.getElementById("ZSInputID_form").value = owner.cells[0].innerHTML;
            document.getElementById("ZSInputNombre").value = owner.cells[1].innerHTML;
            document.getElementById("ZSInputDireccion").value = owner.cells[2].innerHTML;
            document.getElementById("ZSInputTelefono").value = owner.cells[3].innerHTML;
            document.getElementById("ZSInputDetalles").value = owner.cells[4].innerHTML;
        }

        function grupos_showCells(owner) {
            document.getElementById("grupos-InputID").value = owner.cells[0].innerHTML;
            document.getElementById("grupos-InputID_form").value = owner.cells[0].innerHTML;
            document.getElementById("grupos-InputNombre").value = owner.cells[1].innerHTML;
            document.getElementById("grupos-InputDetalles").value = owner.cells[2].innerHTML;
        }

        function documentos_showCells(owner) {
            document.getElementById("documentos-InputID").value = owner.cells[0].innerHTML;
            document.getElementById("documentos-InputID_form").value = owner.cells[0].innerHTML;
            document.getElementById("documentos-InputAbrev").value = owner.cells[1].innerHTML;
            document.getElementById("documentos-InputNombre").value = owner.cells[2].innerHTML;
            document.getElementById("documentos-InputTipo").value = owner.cells[3].innerHTML;
            document.getElementById("documentos-InputNaturaleza").value = owner.cells[4].innerHTML;
            document.getElementById("documentos-InputUso").value = owner.cells[5].innerHTML;
            document.getElementById("documentos-InputDetalles").value = owner.cells[6].innerHTML;
        }

        function terceros_showCells(owner) {
            document.getElementById("terceros-InputID_form").value = owner.cells[0].innerHTML;
            document.getElementById("terceros-InputIdenti").value = owner.cells[1].innerHTML;
            document.getElementById("terceros-InputIdentiClass").value = owner.cells[2].innerHTML;
            document.getElementById("terceros-InputTerceroClass").value = owner.cells[3].innerHTML;
            document.getElementById("terceros-InputNombre").value = owner.cells[4].innerHTML;
            document.getElementById("terceros-InputCiudad").value = owner.cells[5].innerHTML;
            document.getElementById("terceros-InputDireccion").value = owner.cells[6].innerHTML;
            document.getElementById("terceros-InputTel").value = owner.cells[7].innerHTML
            document.getElementById("terceros-InputDetalles").value = owner.cells[8].innerHTML;
        }

        function productos_showCells(owner) {
            document.getElementById("productos-InputID").value = owner.cells[0].innerHTML;
            document.getElementById("productos-InputID_form").value = owner.cells[0].innerHTML;
            document.getElementById("productos-InputGrupo").value = owner.cells[1].innerHTML;
            document.getElementById("productos-InputZona").value = owner.cells[2].innerHTML;
            document.getElementById("productos-InputNombre").value = owner.cells[3].innerHTML;
            document.getElementById("productos-InputUnidad").value = owner.cells[4].innerHTML;
            document.getElementById("productos-InputStock").value = owner.cells[5].innerHTML;
            document.getElementById("productos-InputStockE").value = owner.cells[6].innerHTML;
            document.getElementById("productos-InputOffset").value = owner.cells[7].innerHTML;
            document.getElementById("productos-InputMoneda").value = owner.cells[9].innerHTML;
            document.getElementById("productos-InputCompra").value = owner.cells[10].innerHTML;
            document.getElementById("productos-InputVenta").value = owner.cells[11].innerHTML;
            document.getElementById("productos-InputDetalles").value = owner.cells[12].innerHTML;
        }

        function activeLink(evt, c_name) {
          var i, links;

          links = document.getElementsByClassName(c_name);
          for (i = 0; i < links.length; i++) {
              links[i].className = links[i].className.replace(" w3-black", "");
          }

          evt.currentTarget.className += " w3-black";
        }


        $('form.ajax').submit(function() {
            var btn = $(this).find("input[type=submit]:focus").val();

            var skip;
            var url;
            var forward = false;

            if (btn == "Crear") {
                if (confirm('Crear nueva zona o sucursal ?')) {
                    forward = true;
                }
                skip = "modificarZS";
                url = "../php/handlerZS-cre.php";
            } else if (btn == "Modificar") {
                if (confirm('Modificar zona o sucursal ?')) {
                    forward = true;
                }
                skip = "crearZS";
                url = "../php/handlerZS-mod.php";
            }

            if (forward) {
                var that = $(this),
                    type = that.attr('method'),
                    data = {};

                that.find('[name]').each(function(index, value) {
                    var that = $(this),
                        name = that.attr('name'),
                        value = that.val();

                    if (name != skip) {
                        data[name] = value;
                    }
                });

                $.ajax({
                    url: url,
                    type: type,
                    data: data,
                    /*success: function(response){
                        window.alert(response);
                    }*/
                });
                return false;
            }

        });

        $('form.ajax-grupos').submit(function() {
            var btn = $(this).find("input[type=submit]:focus").val();

            var skip;
            var url;
            var forward = false;

            if (btn == "Crear") {
                if (confirm('Crear nuevo grupo de productos ?')) {
                    forward = true;
                }
                skip = "modificar-grupos";
                url = "../php/handler-grupos-cre.php";
            } else if (btn == "Modificar") {
                if (confirm('Modificar grupo de productos ?')) {
                    forward = true;
                }
                skip = "crear-grupos";
                url = "../php/handler-grupos-mod.php";
            }
            if (forward) {
                var that = $(this),
                    type = that.attr('method'),
                    data = {};

                that.find('[name]').each(function(index, value) {
                    var that = $(this),
                        name = that.attr('name'),
                        value = that.val();

                    if (name != skip) {
                        data[name] = value;
                    }
                });

                $.ajax({
                    url: url,
                    type: type,
                    data: data,
                    /*success: function(response){
                        window.alert(response);
                    }*/
                });
            }

            return false;
        });

        $('form.ajax-documentos').submit(function() {
            var btn = $(this).find("input[type=submit]:focus").val();

            var skip;
            var url;
            var forward = false;

            if (btn == "Crear") {
                if (confirm('Crear nuevo documento ?')) {
                    forward = true;
                }
                skip = "modificar-documentos";
                url = "../php/handler-documentos-cre.php";
            } else if (btn == "Modificar") {
                if (confirm('Modificar documento ?')) {
                    forward = true;
                }
                skip = "crear-documentos";
                url = "../php/handler-documentos-mod.php";
            }

            if (forward) {
                var that = $(this),
                    type = that.attr('method'),
                    data = {};

                that.find('[name]').each(function(index, value) {
                    var that = $(this),
                        name = that.attr('name'),
                        value = that.val();

                    if (name != skip) {
                        data[name] = value;
                    }
                });

                $.ajax({
                    url: url,
                    type: type,
                    data: data,
                    /*success: function(response){
                        window.alert(response);
                    }*/
                });
            }

            return false;
        });

        $('form.ajax-terceros').submit(function() {
            var btn = $(this).find("input[type=submit]:focus").val();

            var skip;
            var url;
            var forward = false;

            if (btn == "Crear") {
                if (confirm('Crear nuevo tercero ?')) {
                    forward = true;
                }
                skip = "modificar-terceros";
                url = "../php/handler-terceros-cre.php";
            } else if (btn == "Modificar") {
                if (confirm('Modificar tercero ?')) {
                    forward = true;
                }
                skip = "crear-terceros";
                url = "../php/handler-terceros-mod.php";
            }

            if (forward) {
                var that = $(this),
                    type = that.attr('method'),
                    data = {};

                that.find('[name]').each(function(index, value) {
                    var that = $(this),
                        name = that.attr('name'),
                        value = that.val();

                    if (name != skip) {
                        data[name] = value;
                    }
                });

                $.ajax({
                    url: url,
                    type: type,
                    data: data,
                    /*success: function(response){
                        window.alert(response);
                    }*/
                });
            }

            return false;
        });

        $('form.ajax-productos').submit(function() {
            var btn = $(this).find("input[type=submit]:focus").val();

            var skip;
            var url;
            var forward = false;

            if (btn == "Crear") {
                if (confirm('Crear nuevo producto ?')) {
                    forward = true;
                }
                skip = "modificar-productos";
                url = "../php/handler-productos-cre.php";
            } else if (btn == "Modificar") {
                if (confirm('Modificar producto ?')) {
                    forward = true;
                }
                skip = "crear-productos";
                url = "../php/handler-productos-mod.php";
            }

            if (forward) {
                var that = $(this),
                    type = that.attr('method'),
                    data = {};

                that.find('[name]').each(function(index, value) {
                    var that = $(this),
                        name = that.attr('name'),
                        value = that.val();

                    if (name != skip) {
                        data[name] = value;
                    }
                });

                $.ajax({
                    url: url,
                    type: type,
                    data: data,
                    success: function(response) {
                        /*window.alert(response);*/
                    }
                });
            }

            return false;
        });

    </script>
</body>

</html>
