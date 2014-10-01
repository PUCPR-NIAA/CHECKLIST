CHECKLIST
=========

Sistema de controle de checklist

- Básico implementado através do cake bake.
- Implementação das funções de alteração de senha do usuário logado e de todos os usuário com controle de administrador;
- Método ADMIN_INDEX dos usuários somente se tiver o campo ADMIN com TRUE;
- Método ADMIN_VIEW dos usuários somente se tiver o campo ADMIN com TRUE.
- Alteração do título do CONTROLLER USERS VIEW;
- Alteração do título do CONTROLLER USERS CHANGEPASSWORD;
- Alteração do título do CONTROLLER USERS ADMIN_CHANGEPASSWORD;
- Alteração do título do CONTROLLER USERS ADMIN_INDEX;
- Alteração do título do CONTROLLER USERS ADMIN_VIEW;
- Alteração do título do CONTROLLER USERS ADMIN_ADD;
- Alteração do título do CONTROLLER USERS ADMIN_EDIT;
- Método ADMIN_ADD dos usuários somente se tiver o campo ADMIN com TRUE;
- Método ADMIN_EDIT dos usuários somente se tiver o campo ADMIN com TRUE;
- Método ADMIN_DELETE dos usuários somente se tiver o campo ADMIN com TRUE.
- Alterado tipo de mensagem de sucesso para SUCCESS do USERS;
- Controle de usuário em todos os métodos com prefixo ADMIN de todos os CONTROLLERS;
- Listar todos os CHECKLISTS do mesmo bloco com turno diferente do usuário logado.
- Adicionado RESTRIÇÃO na listagem do checklist por bloco, turno e data;
- Formato da data mudado para exibição da forma brasileira dd/mm/YYYY;
- Adicionado REPORT para reportar um CHECKLIST de sala de aula;
- Criado MYINDEX para exibição do checklist do usuário logado;
- Alterado os métodos ADD, EDIT, VIEW e DELETE do MODEL CHECKLIST com prefixo ADMIN;
- Método ADMIN_ADD dos checklists somente se tiver o campo ADMIN com TRUE;
- Método ADMIN_EDIT dos checklists somente se tiver o campo ADMIN com TRUE;
- Método ADMIN_VIEW dos checklists somente se tiver o campo ADMIN com TRUE;
- Método ADMIN_DELETE dos checklists somente se tiver o campo ADMIN com TRUE.