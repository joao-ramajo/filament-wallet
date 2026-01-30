# 💰 Fillament Wallet

> Um gerenciador de gastos pessoais simples, eficiente e sem complicações

[![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?style=flat&logo=laravel&logoColor=white)](https://laravel.com)
[![Filament](https://img.shields.io/badge/Filament-Admin-F59E0B?style=flat)](https://filamentphp.com)
[![License](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE)

[🔗 Ver Demo ao Vivo](https://fillament-wallet.salgadinhos-web.blog)

---

## 📖 Sobre o Projeto

**Fillament Wallet** é um gerenciador de gastos pessoais que nasceu da necessidade de ter uma ferramenta **gratuita, simples e confiável** para controle financeiro. Diferente de outros aplicativos disponíveis no mercado, este projeto foca em:

- ✅ **Simplicidade** - Interface limpa sem funcionalidades desnecessárias
- ✅ **Confiabilidade** - Seus dados sob seu controle
- ✅ **Experiência focada** - Sem distrações, apenas o essencial para manter suas finanças em dia

### 🎯 Problema Resolvido

Centraliza o controle de saldo e gerencia expectativas financeiras de forma clara, ajudando você a visualizar rapidamente o impacto de cada despesa ou receita no seu orçamento.

### 💡 Por que outro gerenciador de gastos?

A maioria dos aplicativos de controle financeiro sofrem de:
- Interfaces excessivamente complicadas
- Questões de segurança e privacidade duvidosas
- Recursos "empurrados" que prejudicam a experiência
- Complexidade que desmotiva o uso contínuo

**Fillament Wallet** foi criado para resolver esses problemas, oferecendo apenas o necessário para um controle financeiro efetivo.

---

## ✨ Principais Funcionalidades

| Funcionalidade | Descrição |
|----------------|-----------|
| 📝 **CRUD de Despesas** | Crie, edite, visualize e exclua suas transações financeiras |
| 📊 **Relatórios Gerais** | Visualize resumos e análises dos seus gastos |
| 📥 **Importação de Planilhas** | Importe seus dados de gastos via arquivo Excel/CSV |
| 📤 **Exportação de Dados** | Exporte seus registros para análise externa |
| 💵 **Controle de Saldo** | Acompanhe saldo atual e projeções futuras em tempo real |

---

## 🛠️ Tecnologias Utilizadas

Este projeto foi construído com tecnologias modernas e confiáveis:

- **Laravel 12** - Framework PHP robusto e elegante
- **Filament** - Admin panel poderoso para Laravel
- **Blade Components** - Sistema de templates do Laravel
- **MySQL** - Banco de dados relacional via Docker
- **Docker** - Containerização para ambiente consistente

### Arquitetura

- **Tipo**: Monolito server-side
- **Padrão**: DDD Lite (Domain-Driven Design simplificado)
- **Stack**: Full-stack Laravel (Frontend + Backend integrados)

---

## 🚀 Como Começar

### Pré-requisitos

Antes de iniciar, certifique-se de ter instalado:

- [Docker](https://www.docker.com/get-started) (para Laravel Sail)
- [Composer](https://getcomposer.org/) (gerenciador de dependências PHP)

### Instalação

1. **Clone o repositório**
```bash
git clone https://github.com/seu-usuario/fillament-wallet.git
cd fillament-wallet
```

2. **Instale as dependências**
```bash
composer install
```

3. **Configure o ambiente**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Suba os containers Docker**
```bash
./vendor/bin/sail up -d
```

5. **Execute as migrations**
```bash
./vendor/bin/sail artisan migrate
```

6. **Acesse a aplicação**
```
http://localhost
```

### Comandos Úteis

```bash
# Rodar o projeto em desenvolvimento
./vendor/bin/sail up -d

# Parar o projeto
./vendor/bin/sail down

# Executar testes
./vendor/bin/sail artisan test

# Acessar o container
./vendor/bin/sail shell
```

---

## 💡 Exemplo de Uso

### Caso de Uso Típico

1. **Cadastre uma despesa** (ex: "Compra no supermercado - R$ 150,00")
2. **Visualize o impacto** no seu saldo atual e saldo projetado
3. **Acompanhe** como suas entradas e saídas afetam seu orçamento
4. **Exporte** relatórios quando precisar analisar seus gastos em detalhe

A cada transação registrada, o sistema automaticamente atualiza:
- Saldo atual
- Saldo final projetado
- Relatórios e gráficos

---

## 🎨 Design

O projeto segue um estilo **neo-brutalista**, priorizando:
- Funcionalidade sobre ornamentação
- Contraste e legibilidade
- Elementos visuais diretos e honestos

---

## 🧪 Testes

O projeto conta com testes básicos para garantir a estabilidade das operações principais.

```bash
./vendor/bin/sail artisan test
```

**Nota**: Como as operações são relativamente simples, a cobertura de testes é focada nos fluxos principais, sem necessidade de testes complexos.

---

## 📈 Status do Projeto

**Status Atual**: ✅ MVP em Produção

O projeto está deployado e funcionando em ambiente de produção (VPS), pronto para uso real.

### 🗺️ Roadmap

Funcionalidades planejadas para as próximas versões:

- [ ] Melhorar exportação de planilhas para melhor usabilidade
- [ ] Implementar envio de relatórios semanais via email
- [ ] Área de sugestões da comunidade
- [ ] Dashboard com gráficos interativos
- [ ] Categorização automática de gastos

---

## 🤝 Contribuições

Contribuições são bem-vindas! Este projeto aceita:

- 💡 **Sugestões de melhorias**
- 🐛 **Relatos de bugs**
- 📝 **Melhorias na documentação**

> **Em breve**: Uma área dedicada para sugestões da comunidade será implementada.

---

## 🔗 Links

- **Demo ao vivo**: [https://fillament-wallet.salgadinhos-web.blog](https://fillament-wallet.salgadinhos-web.blog)
- **Documentação do Laravel**: [https://laravel.com/docs](https://laravel.com/docs)
- **Documentação do Filament**: [https://filamentphp.com/docs](https://filamentphp.com/docs)
