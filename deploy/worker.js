import { Container, getContainer } from '@cloudflare/containers';
import { env } from 'cloudflare:workers';

export class RachiContainer extends Container {
    defaultPort = 8080;
    sleepAfter = '5m';
    envVars = {
        APP_NAME: 'RACHI',
        APP_ENV: 'production',
        APP_DEBUG: 'false',
        APP_KEY: env.APP_KEY,
        APP_URL: env.APP_URL,
        APP_LOCALE: 'pt',
        APP_TIMEZONE: 'Africa/Luanda',
        DB_CONNECTION: 'pgsql',
        DB_HOST: env.DB_HOST,
        DB_PORT: '5432',
        DB_DATABASE: 'postgres',
        DB_USERNAME: env.DB_USERNAME,
        DB_PASSWORD: env.DB_PASSWORD,
        DB_SSLMODE: 'require',
        SESSION_DRIVER: 'database',
        SESSION_SECURE_COOKIE: 'true',
        SESSION_ENCRYPT: 'true',
        LOG_CHANNEL: 'stderr',
        QUEUE_CONNECTION: 'sync',
        CACHE_STORE: 'file',
    };
}

export default {
    async fetch(request, bindings) {
        const forwarded = new Request(request);
        forwarded.headers.set('X-Forwarded-Proto', 'https');
        forwarded.headers.set('X-Forwarded-Host', new URL(request.url).host);
        return getContainer(bindings.RACHI, 'production').fetch(forwarded);
    },
};
