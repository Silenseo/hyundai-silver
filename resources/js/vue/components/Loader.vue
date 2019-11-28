<template>
  <div class="loader-overlay">
    <div class="loader">Loading...</div>
  </div>
</template>

<script>
export default {
  name: 'Looader'
}
</script>

<style lang="scss">
@import '../assets/_mixins.scss';

.loader-overlay {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background: #fff;
  z-index: 10;
}
.loader,
.loader:before,
.loader:after {
  border-radius: 50%;
  width: 2.5em;
  height: 2.5em;
  animation-fill-mode: both;
  animation: load7 1.8s infinite ease-in-out;
}
.loader {
  color: rgb(19,180,216);
  font-size: 9px;
  margin: 0 auto;
  position: absolute;
  top: 50%;
  left: 0;
  right: 0;
  text-indent: -9999em;
//   transform: translate3d(0,-50%,0);
  animation-delay: -0.16s;
}
.loader:before,
.loader:after {
  content: '';
  position: absolute;
  top: 0;
}
.loader:before {
  left: -3.5em;
  animation-delay: -0.32s;
}
.loader:after {
  left: 3.5em;
}
@keyframes load7 {
  0%,
  80%,
  100% {
    box-shadow: 0 2.5em 0 -1.3em;
  }
  40% {
    box-shadow: 0 2.5em 0 0;
  }
}
</style>
