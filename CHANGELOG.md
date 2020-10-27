# Changelog
Todas as mudanças importantes neste projeto estarão documentadas neste arquivo.

O formato é baseado no [Keep a Changelog](https://keepachangelog.com/pt-BR/1.0.0/), e este projeto adere ao [Versionamento Semântico](https://semver.org/spec/v2.0.0.html)

## [Não publicado]

## [1.1.0] - 2020-10-27

###Corrigido
- Bugifx: Erros de chave não encontrada quando Correios não retorna resultado
- Bugfix: Respondendo Response vazio caso Correios retorne vazio por timeout

###Modificado
- Ajustando ordem do log
- Aumentando timeout para 30 segundos


## [1.0.0] - 2020-07-23
### Adicionado
- Encomenda tipo caixa com calculo de dimensões com vários itens usando raíz cúbica
- Encomenta tipo caixa recebe apenas um único item e usa suas dimensões
- Encomenda tipo rolo
- Encomenda tipo Envelope
- Calculo dos preços e prazos de uma remessa com todos os itens juntos
- Calculo dos preços e prazos de uma remessa com todos os itens separados e somando os valores [response vai diferente]
- Calculo dos preços e prazos de uma remessa com separando itens com dimensão abaixo e acima de um limite estabelecido (padrão 70cm) e somando no final


