document.addEventListener('DOMContentLoaded', function () {
    // NProgress 配置项
    const nprogressConfig = {
        minimum: 0.1,
        easing: 'ease',
        speed: 500,
        showSpinner: true,
        trickle: true,
        trickleSpeed: 200
    };

    NProgress.configure(nprogressConfig);
    NProgress.start();

    // 页面加载完成后结束进度条
    window.addEventListener('load', function () {
        NProgress.done();
    });

    // 设置超时兜底机制（防止某些资源未触发 load 事件）
    setTimeout(() => {
        if (NProgress.isStarted() && !NProgress.isDone()) {
            NProgress.done();
        }
    }, 1500); // 延迟略大于正常加载时间
});