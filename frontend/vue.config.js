// vue.config.js
module.exports = {
    devServer: {
        proxy: {
            "/api": {
                target: "http://localhost:8000",
                changeOrigin: true,
                pathRewrite: { "^/api": "" },
            },
        },
    },
    publicPath: process.env.NODE_ENV === "production" ? "/" : "/",
};
