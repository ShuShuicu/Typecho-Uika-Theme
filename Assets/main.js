/* 
    Typecho Theme Development Framework
    TTDF · 一个面向小白简单易懂的Typecho主题模板开发框架
    @Author 鼠子Tomoriゞ
    https://github.com/ShuShuicu/Typecho-Theme-Development-Framework
*/

document.addEventListener('DOMContentLoaded', () => {
    // 配置进度条
    const configureProgress = () => {
        if (typeof NProgress !== 'undefined') {
            NProgress.configure({
                minimum: 0.1,
                easing: 'ease',
                speed: 500,
                showSpinner: true,
                trickle: true,
                trickleSpeed: 200
            });
            NProgress.start();

            // 设置进度条完成条件
            window.addEventListener('load', () => NProgress?.done());
            setTimeout(() => NProgress?.done(), 1000);
        }
    };

    // 检查依赖是否可用
    const checkDependencies = () => {
        return typeof Vue === 'object' &&
            typeof ArcoVue === 'object' &&
            ArcoVue.install;
    };

    // 初始化Vue应用
    const initializeApp = () => {
        try {
            if (!checkDependencies()) {
                throw new Error('Vue或ArcoVue未正确加载');
            }

            const { createApp } = Vue;

            // 检查是否已有实例
            if (document.querySelector('#app[data-v-app]')) {
                console.warn('已有Vue应用实例，跳过初始化');
                return;
            }

            const app = createApp({
                data() {
                    return {
                        Uika: '',
                    };
                }
            });

            // 注册ArcoVue组件
            app.use(ArcoVue);

            // 确保挂载点存在
            let mountPoint = document.querySelector('#app');
            if (!mountPoint) {
                mountPoint = document.createElement('div');
                mountPoint.id = 'app';
                document.body.appendChild(mountPoint);
            }

            app.mount(mountPoint);
            mdui?.mutation();
            console.log('Vue应用挂载成功');
        } catch (error) {
            console.error('应用初始化失败:', error);
        }
    };

    // 观察依赖加载
    const setupObserver = () => {
        if (checkDependencies()) {
            initializeApp();
            return;
        }

        const observer = new MutationObserver(() => {
            if (checkDependencies()) {
                observer.disconnect();
                initializeApp();
            }
        });

        observer.observe(document.head, { childList: true, subtree: true });

        setTimeout(() => {
            observer.disconnect();
            if (checkDependencies()) {
                initializeApp();
            } else {
                console.error('Vue或ArcoVue加载超时');
            }
        }, 5000);
    };

    // 初始化搜索功能
    const initializeSearch = () => {
        const searchButton = document.getElementById('searchButton');
        if (!searchButton) {
            console.error('搜索按钮元素未找到');
            return;
        }

        searchButton.addEventListener('click', () => {
            Swal.fire({
                title: '搜索内容',
                input: 'text',
                inputPlaceholder: '请输入关键词...',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: '搜索',
                cancelButtonText: '取消',
                showLoaderOnConfirm: true,
                preConfirm: (keyword) => {
                    if (!keyword) {
                        Swal.showValidationMessage('请输入搜索内容');
                        return false;
                    }
                    return new Promise((resolve) => {
                        setTimeout(() => resolve(), 100);
                    });
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    const encodedKeyword = encodeURIComponent(result.value);
                    window.location.href = `/search/${encodedKeyword}`;
                }
            });
        });
    };

    // 主初始化函数
    const initialize = () => {
        configureProgress();
        setupObserver();
        initializeSearch();
    };

    // 执行初始化
    initialize();
});

// 切换主题
function switchTheme() {
    const body = document.body;
    const currentTheme = body.getAttribute('arco-theme') || 'light';
    const newTheme = currentTheme === 'light' ? 'dark' : 'light';

    // 切换 arco-theme 属性
    body.setAttribute('arco-theme', newTheme);

    // 切换 mdui-theme-layout 类
    body.classList.remove(`mdui-theme-layout-${currentTheme}`);
    body.classList.add(`mdui-theme-layout-${newTheme}`);

    // 保存主题状态到 localStorage
    localStorage.setItem('theme', newTheme);

    // 使用 ArcoVue 的全局提示
    if (typeof ArcoVue !== 'undefined') {
        const message = ArcoVue.Message;
        message.success(`已切换至 ${newTheme === 'light' ? '亮色' : '暗色'} 主题`);
    }
}

// 页面加载时应用保存的主题
document.addEventListener('DOMContentLoaded', () => {
    const savedTheme = localStorage.getItem('theme') || 'light';
    document.body.setAttribute('arco-theme', savedTheme);
    document.body.classList.add(`mdui-theme-layout-${savedTheme}`);
});

/**
 * @description: ajax请求封装
 * @param {*} _this 按钮的jquery对象
 * @param {*} data 传递的数据
 * @param {*} success 成功后的回调函数
 * @param {*} noty 提示信息
 * @param {*} no_loading 是否不显示加载动画
 * @return {*}
 */
function TyAjax(_this, data, success, noty, no_loading) {
    if (_this.attr('disabled')) {
        return !1;
    }
    if (!data) {
        var _data = _this.attr('form-data');
        if (_data) {
            try {
                data = $.parseJSON(_data);
            } catch (e) { }
        }
        if (!data) {
            var form = _this.parents('form');
            data = form.serializeObject();
        }
    }

    var _action = _this.attr('form-action');
    if (_action) {
        data.action = _action;
    }

    // 人机验证
    if (data.captcha_mode && typeof is_captcha === 'function' && is_captcha(data.captcha_mode)) {
        tbquire(['captcha'], function () {
            CaptchaOpen(_this, data.captcha_mode);
        });
        return !1;
    }

    if (window.captcha) {
        data.captcha = JSON.parse(JSON.stringify(window.captcha));
        data.captcha._this && delete data.captcha._this;
        window.captcha = {};
    }

    var _text = _this.html();
    var _loading = no_loading ? _text : '<i class="loading mr6"></i><text>请稍候</text>';

    // 创建加载提示（使用固定ID）
    var noticeId = 'tyajax_notice_' + Date.now();
    if (noty != 'stop') {
        notyf(noty || '正在处理请稍后...', 'load', 0, noticeId);
    }

    _this.attr('disabled', true).html(_loading);
    var _url = _this.attr('ajax-href') || window.location.href;

    $.ajax({
        type: 'POST',
        url: _url,
        data: data,
        dataType: 'json',
        error: function (n) {
            var _msg = '操作失败 ' + n.status + ' ' + n.statusText + '，请刷新页面后重试';
            if (n.responseText && n.responseText.indexOf('致命错误') > -1) {
                _msg = '网站遇到致命错误，请检查插件冲突或通过错误日志排除错误';
            }
            console.error('ajax请求错误，错误信息如下：', n);

            // 直接更新提示内容（不关闭）
            notyf(_msg, 'danger', 5000, noticeId);

            _this.attr('disabled', false).html(_text);
        },
        success: function (n) {
            var ys = n.ys ? n.ys : n.error ? 'danger' : 'success';
            if (n.error) {
                typeof _win !== 'undefined' && (_win.slidercaptcha = false);
                data.tcaptcha_ticket && (tcaptcha = {});
            }

            // 直接更新提示内容（不关闭）
            if (noty != 'stop') {
                notyf(n.msg || '处理完成', ys, 3000, noticeId);
            } else if (n.msg) {
                notyf(n.msg, ys, 3000);
            }

            _this.attr('disabled', false).html(_text).trigger('TyAjax.success', n);
            $.isFunction(success) && success(n, _this, data);

            if (n.hide_modal) {
                _this.closest('.modal').modal('hide');
            }
            if (n.reload) {
                if (n.goto) {
                    window.location.href = n.goto;
                    window.location.reload;
                } else {
                    window.location.reload();
                }
            }
        },
    });
}

// 事件绑定保持与zib_ajax一致
$(document).on('TyAjax.success', '[next-tab]', function (e, n) {
    var _next = $(this).attr('next-tab');
    if (_next && n && !n.error) {
        $('a[href="#' + _next + '"]').tab('show');
    }
});
jQuery(function ($) {
    $('body').on('click', '.ty-ajax-submit', function (e) {
        e.preventDefault();
        TyAjax($(this));
    });

    $.fn.serializeObject = function () {
        var obj = {};
        $.each(this.serializeArray(), function () {
            obj[this.name] = obj[this.name] !== undefined ?
                [].concat(obj[this.name], this.value || '') :
                this.value || '';
        });
        return obj;
    };
});

/**
 * ViewImage.min.js 2.0.2
 * MIT License - http://www.opensource.org/licenses/mit-license.php
 * https://tokinx.github.io/ViewImage/
 */
var $jscomp = $jscomp || {}; $jscomp.scope = {}; $jscomp.createTemplateTagFirstArg = function (b) { return b.raw = b }; $jscomp.createTemplateTagFirstArgWithRaw = function (b, a) { b.raw = a; return b }; $jscomp.arrayIteratorImpl = function (b) { var a = 0; return function () { return a < b.length ? { done: !1, value: b[a++] } : { done: !0 } } }; $jscomp.arrayIterator = function (b) { return { next: $jscomp.arrayIteratorImpl(b) } }; $jscomp.makeIterator = function (b) { var a = "undefined" != typeof Symbol && Symbol.iterator && b[Symbol.iterator]; return a ? a.call(b) : $jscomp.arrayIterator(b) };
$jscomp.arrayFromIterator = function (b) { for (var a, d = []; !(a = b.next()).done;)d.push(a.value); return d }; $jscomp.arrayFromIterable = function (b) { return b instanceof Array ? b : $jscomp.arrayFromIterator($jscomp.makeIterator(b)) };
(function () {
    window.ViewImage = new function () {
        var b = this; this.target = "[view-image] img"; this.listener = function (a) { if (!(a.ctrlKey || a.metaKey || a.shiftKey || a.altKey)) { var d = String(b.target.split(",").map(function (g) { return g.trim() + ":not([no-view])" })), c = a.target.closest(d); if (c) { var e = c.closest("[view-image]") || document.body; d = [].concat($jscomp.arrayFromIterable(e.querySelectorAll(d))).map(function (g) { return g.href || g.src }); b.display(d, c.href || c.src); a.stopPropagation(); a.preventDefault() } } }; this.init =
            function (a) { a && (b.target = a);["removeEventListener", "addEventListener"].forEach(function (d) { document[d]("click", b.listener, !1) }) }; this.display = function (a, d) {
                var c = a.indexOf(d), e = (new DOMParser).parseFromString('\n                <div class="view-image">\n                    <style>.view-image{position:fixed;inset:0;z-index:114514;padding:1rem;display:flex;flex-direction:column;animation:view-image-in 300ms;backdrop-filter:blur(20px);-webkit-backdrop-filter:blur(20px)}.view-image__out{animation:view-image-out 300ms}@keyframes view-image-in{0%{opacity:0}}@keyframes view-image-out{100%{opacity:0}}.view-image-btn{width:32px;height:32px;display:flex;justify-content:center;align-items:center;cursor:pointer;border-radius:3px;background-color:rgba(255,255,255,0.2)}.view-image-btn:hover{background-color:rgba(255,255,255,0.5)}.view-image-close__full{position:absolute;inset:0;background-color:rgba(48,55,66,0.3);z-index:unset;cursor:zoom-out;margin:0}.view-image-container{height:0;flex:1;display:flex;align-items:center;justify-content:center;}.view-image-lead{display:contents}.view-image-lead img{position:relative;z-index:1;max-width:100%;max-height:100%;object-fit:contain;border-radius:3px}.view-image-lead__in img{animation:view-image-lead-in 300ms}.view-image-lead__out img{animation:view-image-lead-out 300ms forwards}@keyframes view-image-lead-in{0%{opacity:0;transform:translateY(-20px)}}@keyframes view-image-lead-out{100%{opacity:0;transform:translateY(20px)}}[class*=__out] ~ .view-image-loading{display:block}.view-image-loading{position:absolute;inset:50%;width:8rem;height:2rem;color:#aab2bd;overflow:hidden;text-align:center;margin:-1rem -4rem;z-index:1;display:none}.view-image-loading::after{content:"";position:absolute;inset:50% 0;width:100%;height:3px;background:rgba(255,255,255,0.5);transform:translateX(-100%) translateY(-50%);animation:view-image-loading 800ms -100ms ease-in-out infinite}@keyframes view-image-loading{0%{transform:translateX(-100%)}100%{transform:translateX(100%)}}.view-image-tools{position:relative;display:flex;justify-content:space-between;align-content:center;color:#fff;max-width:600px;position: absolute; bottom: 5%; left: 1rem; right: 1rem; backdrop-filter: blur(10px);margin:0 auto;padding:10px;border-radius:5px;background:rgba(0,0,0,0.1);margin-bottom:constant(safe-area-inset-bottom);margin-bottom:env(safe-area-inset-bottom);z-index:1}.view-image-tools__count{width:60px;display:flex;align-items:center;justify-content:center}.view-image-tools__flip{display:flex;gap:10px}.view-image-tools [class*=-close]{margin:0 10px}</style>\n                    <div class="view-image-container">\n                        <div class="view-image-lead"></div>\n                        <div class="view-image-loading"></div>\n                        <div class="view-image-close view-image-close__full"></div>\n                    </div>\n                    <div class="view-image-tools">\n                        <div class="view-image-tools__count">\n                            <span><b class="view-image-index">' +
                    (c + 1) + "</b>/" + a.length + '</span>\n                        </div>\n                        <div class="view-image-tools__flip">\n                            <div class="view-image-btn view-image-tools__flip-prev">\n                                <svg width="20" height="20" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="48" height="48" fill="white" fill-opacity="0.01"/><path d="M31 36L19 24L31 12" stroke="white" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/></svg>\n                            </div>\n                            <div class="view-image-btn view-image-tools__flip-next">\n                                <svg width="20" height="20" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="48" height="48" fill="white" fill-opacity="0.01"/><path d="M19 12L31 24L19 36" stroke="white" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/></svg>\n                            </div>\n                        </div>\n                        <div class="view-image-btn view-image-close">\n                            <svg width="16" height="16" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="48" height="48" fill="white" fill-opacity="0.01"/><path d="M8 8L40 40" stroke="white" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/><path d="M8 40L40 8" stroke="white" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/></svg>\n                        </div>\n                    </div>\n                </div>\n            ',
                    "text/html").body.firstChild, g = function (f) { var h = { Escape: "close", ArrowLeft: "tools__flip-prev", ArrowRight: "tools__flip-next" }; h[f.key] && e.querySelector(".view-image-" + h[f.key]).click() }, l = function (f) {
                        var h = new Image, k = e.querySelector(".view-image-lead"); k.className = "view-image-lead view-image-lead__out"; setTimeout(function () {
                            k.innerHTML = ""; h.onload = function () { setTimeout(function () { k.innerHTML = '<img src="' + h.src + '" alt="ViewImage" no-view/>'; k.className = "view-image-lead view-image-lead__in" }, 100) };
                            h.src = f
                        }, 300)
                    }; document.body.appendChild(e); l(d); window.addEventListener("keydown", g); e.onclick = function (f) { f.target.closest(".view-image-close") ? (window.removeEventListener("keydown", g), e.onclick = null, e.classList.add("view-image__out"), setTimeout(function () { return e.remove() }, 290)) : f.target.closest(".view-image-tools__flip") && (c = f.target.closest(".view-image-tools__flip-prev") ? 0 === c ? a.length - 1 : c - 1 : c === a.length - 1 ? 0 : c + 1, l(a[c]), e.querySelector(".view-image-index").innerHTML = c + 1) }
            }
    }
})();
