<!-- Note -->
<div class="nNote nInformation hideit">
    <p><strong>INFORMAÇÃO: </strong>Utilize com cuidado a opção de criar usuário.</p>
</div>
<form action="index.php?acao=cadastraUsuario&ctrl=usuarios" target="iframeCadUsuario" name="frmCadUsuario" id="frmCadUser" method="post" enctype="multipart/form-data" class="SignupForm">
    <div>
        <div class="widget">
            <div class="title"><img src="images/icons/dark/alert.png" alt="" class="titleIcon" />
                <h6>Usuário</h6>
            </div>
            <fieldset class="step">
                <h1>Dados do usuário</h1>
                <div class="formRow">
                    <label>Nome:<span class="req">*</span></label>
                    <div class="formRight">
                        <input type="text" class="validate[required] tipS" title="Nome do usuário do sistema." name="nome" id="nome" title="Nome" value="" />
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                    <label>Senha:<span class="req">*</span></label>
                    <div class="formRight">
                        <input type="password" class="validate[required] tipS" title="Senha para acessar o sistema, coloque uma senha com letras e números." name="senha" id="senha" value="" />
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                    <label>Confirmar Senha:<span class="req">*</span></label>
                    <div class="formRight">
                        <input type="password" name="confirma_senha" id="confirma_senha" class="validate[required,equals[senha]] tipS" title="Confirme sua senha, deve ser igual a senha acima." value="" />
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                    <label>E-mail / login:<span class="req">*</span></label>
                    <div class="formRight">
                        <input type="text" class="validate[required,maxSize[255],custom[email]] tipS" title="Seu email, deve ser uma email válido." name="email" id="email" value="" />
                    </div>
                    <div class="clear"></div>
                </div>
            </fieldset>
            <fieldset class="step">
                <h1>Imagem do usuário</h1>
                <div class="formRow">
                    <label>Imagem:</label>
                    <div class="formRight">
                        <input type="file" id="img" name="img" class="tipS" title="Imagem do usuário do sistema." />
                    </div>
                    <div class="clear"></div>
                </div>
            </fieldset>
            <fieldset class="step">
                <h1>Nível do usuário</h1>
                <div class="formRow">
                    <label>Status:<span class="req">*</span></label>
                    <div class="formRight">
                        <select name="status" id="status" class="validate[required] tipS" title="Se ativo ele pode logar no sistema, se inativo ele não acessa o sistema.">
                            <option value="1">Ativo</option>
                            <option value="0">Inativo</option>
                        </select>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                    <label>Nível:<span class="req">*</span></label>
                    <div class="formRight">
                        <select name="nivel" id="nivel" class="tipS" title="Administrator tem acesso as configurações do sistema, o nível usuário não tem acesso as configurações do sistema.">
                            <option value="1">Administrador</option>
                            <option value="0" selected>Usuário</option>
                        </select>
                    </div>
                    <div class="clear"></div>
                </div>
            </fieldset>


        </div>
    </div>
    <div>
        <fieldset class="step">
            <h1>Nível do usuário</h1>
            <!-- Media table -->
            <div class="widget">
                <div class="title">
                    <h6>Permissão do usuário</h6>
                </div>
                <table cellpadding="0" cellspacing="0" width="100%" class="sTable withCheck mTable" id="checkAll">
                    <thead>
                        <tr>
                            <td height="27">Módulo</td>
                            <td>Módulo</td>
                            <td>Cadastrar</td>
                            <td>Alterar</td>
                            <td>Excluir</td>
                            <td>Publicar</td>
                        </tr>
                    </thead>

                    <tbody class="prachegar">
                        <?

                        if ($secoes_fixas["num"] > 0) {

                            for ($i = 0; $i < $secoes_fixas["num"]; $i++) {
                        ?>
                                <tr class="secoesParaChecar<?php echo $i ?>">
                                    <td><input name="secao_fixa[]" id="todosFixa<?php echo $i ?>" type="checkbox" onclick="selecionarTodosItensUsuario('<?php echo $i ?>')" value="<?php echo $secoes_fixas[$i]->id; ?>" /></td>
                                    <td align="center"><?php echo $secoes_fixas[$i]->menu ?></td>
                                    <td><input type="checkbox" class="cadastrarFixa<?php echo $i ?>" name="cadastrar_fixa[<?php echo $secoes_fixas[$i]->id; ?>]" value="1" /></td>
                                    <td><input type="checkbox" class="alterarFixa<?php echo $i ?>" name="alterar_fixa[<?php echo $secoes_fixas[$i]->id; ?>]" value="1" /></td>
                                    <td><input type="checkbox" class="excluirFixa<?php echo $i ?>" name="excluir_fixa[<?php echo $secoes_fixas[$i]->id; ?>]" value="1" /></td>
                                    <td><input type="checkbox" class="publicarFixa<?php echo $i ?>" name="publicar_fixa[<?php echo $secoes_fixas[$i]->id; ?>]" value="1" /></td>
                                </tr>
                        <?
                            }
                        }

                        ?>
                        <tr>
                            <td colspan="6">
                                <?php if ($permissao->cadastrar == 1) { ?>
                                    <input type="submit" class="button blackB" style="margin: 18px; float: right;" name="salvar" value="Cadastrar" onClick="$('#frmCadUsuario').submit();" />
                                <?php } ?>
                                <!--<input type="button" value="Voltar" name="voltar" id="voltar" onclick="javascript:history.go(-1)" class="button blueB" style="margin: 18px 0 0 0; float: right;" />-->
                                <iframe name="iframeCadUsuario" frameborder="0" width="0" height="0"></iframe>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </fieldset>
    </div>
</form>