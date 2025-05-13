document.addEventListener('DOMContentLoaded', () => {
    const observer = new MutationObserver(() => {
        if (typeof Vue === 'object' && typeof ArcoVue === 'object' && ArcoVue.install) {
            observer.disconnect();
            initializeApp();
            // Vue 初始化完成后再初始化 MDUI
            mdui.mutation();
        }
    });

    function initializeApp() {
        const { createApp } = Vue;
        const app = createApp({ /* 应用选项 */ });
        app.use(ArcoVue); // 使用 ArcoVue 组件

        const mountPoint = document.querySelector('#app:not([data-v-app])');
        if (mountPoint) {
            app.mount(mountPoint);
        } else {
            console.error('挂载点不可用');
        }
    }

    // 开始观察
    observer.observe(document.head, {
        childList: true,
        subtree: true
    });

    // 超时处理
    setTimeout(() => {
        observer.disconnect();
        if (typeof Vue === 'object' && typeof ArcoVue === 'object') {
            initializeApp();
        } else {
            console.error('资源加载超时');
        }
    }, 5000);
});
