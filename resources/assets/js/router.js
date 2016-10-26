// const System = { template: '<div>System</div>' }
import System from './components/Content.vue'
const Config = { template: '<div>Config</div>' }
const Upload = { template: '<div>Upload</div>' }
const routes = [
    { path: '/system', component: System },
    { path: '/config', component: Config },
    { path: '/upload', component: Upload }
]

export default routes;
