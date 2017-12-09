<template>
    <div class="btn_alertas">
        <span  class="icon-campana btn_alertas_img" id="clich1">
            <img id="zona_alerta_btn" class="img_alertas" src="/imagenes/iconos/icono-alerta.svg" alt="">
        </span>
        <div class="zona-cant-not flex" id="zona_alerta_cont_cant" v-if="notificaciones.length">
            <div id="zona_alerta_cant" class="cant-not"  v-text="notificaciones.length"></div>
        </div>
        <div class="menu-alertas" id="menu_alertas_flotante" v-if="notificaciones.length">

            <div class="flecha-up"></div>

            <div class="lista-alertas">
                <div class="cabecera-lista-alertas">
                    <div class="titulo-lista-alertas">
                        <span>Últimos Cuestionarios</span>
                    </div>
                </div>
                <div class="scrollbar lista-notificaciones " id="style-3">
                    <ul class="lista-alertas-items">
                        <li class="item">
                            <a @click="marcarComoLeido(notificacion)" :href="notificacion.url" v-for="notificacion in notificaciones">
                                <div class="lista-alertas-items-escritura" >
                                    <div class="lista-alertas-items-escritura-cliente" v-text="notificacion.cliente"></div>
                                    <div class="lista-alertas-items-escritura-notificacion texto-centrar" v-text="notificacion.encuesta"></div>
                                    <div class="texto-centrar" style="color: red; font-size:12px;" v-text="notificacion.resultado"></div>
                                    <div class="lista-alertas-items-escritura-usuarionotificador" v-text="notificacion.encuestador">
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="ver-todas-notificaciones">
                    <a class="es-link" @click="marcarTodoLeido()" href="">Marcar todas como leidas</a>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
.menu-alertas{
    display: none;
}


</style>

<script>
    export default {

        data(){
            return {
                notificaciones:[]
            }
        },
        mounted() {
            axios.get('/notificaciones').then(res => {
                this.notificaciones = res.data;
                // console.log(res.data)
            })
        },
        methods: {
            marcarComoLeido(notificacion){
                axios.patch('/notificaciones/' + notificacion.id);
            },
            marcarTodoLeido(){
                this.notificaciones.forEach(notificacion => {
                    this.marcarComoLeido(notificacion);
                });
            }
        }

    }
</script>
