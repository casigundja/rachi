# Guia de Ambientes: Homologação e Produção — RACHI

Este projeto está configurado com dois ambientes completamente isolados: **Homologação (Staging)** e **Produção (Production)**, tanto localmente na sua máquina quanto na Cloudflare.

---

## 1. Visão Geral dos Ambientes

| Recurso | Homologação (Staging) | Produção (Production) |
| :--- | :--- | :--- |
| **Objetivo** | Testes, validação de novas telas e regras | Ambiente oficial aberto aos clientes |
| **URL Web** | `https://rachi-staging.casimirogundja.workers.dev` | `https://rachi.ao` (e `admin.rachi.ao`) |
| **Banco D1 Cloudflare** | `rachi-db-staging` (`902a75e4-...`) | `rachi-db` (`3d45fd42-...`) |
| **Banco Local** | `database/database_staging.sqlite` | `database/database.sqlite` |
| **Arquivo de Ambiente** | `.env.staging` | `.env.production` |
| **Branch Git** | `staging` | `main` |

---

## 2. Como Alternar o Ambiente Localmente na Máquina

Criamos o script utilitário `switch-env.ps1`:

### Para trabalhar em Homologação:
```powershell
.\switch-env.ps1 staging
```
*Isso ativa o `.env.staging` e conecta ao banco de homologação local.*

### Para trabalhar em Produção:
```powershell
.\switch-env.ps1 prod
```
*Isso restaura o `.env.production` e conecta ao banco de produção local.*

---

## 3. Comandos Rápidos (`npm run`)

No terminal, você pode rodar:

- **Subir alterações para Homologação:**
  ```bash
  npm run deploy:staging
  ```
- **Subir alterações para Produção:**
  ```bash
  npm run deploy:prod
  ```
- **Executar SQL na Homologação Remota (D1):**
  ```bash
  npm run d1:staging -- --command "SELECT count(*) FROM users"
  ```
- **Executar SQL na Produção Remota (D1):**
  ```bash
  npm run d1:prod -- --command "SELECT count(*) FROM users"
  ```

---

## 4. Fluxo Recomendado de Trabalho (Git)

1. Mude para a branch de homologação:
   ```bash
   git checkout staging
   .\switch-env.ps1 staging
   ```
2. Faça as suas alterações, testes e envie para o ambiente de testes:
   ```bash
   npm run deploy:staging
   ```
3. Teste em `https://rachi-staging.casimirogundja.workers.dev`.
4. Estando tudo aprovado, junte as alterações na branch principal (`main`):
   ```bash
   git checkout main
   git merge staging
   git push origin main
   npm run deploy:prod
   ```
