<!-- Note -->
<div class="nNote nInformation hideit">
    <p><strong>INFORMAÇÃO: </strong>Utilize com cuidado a opção de criar usuário.</p>
</div>
<form action="index.php?acao=alteraUsuario&ctrl=usuarios" target="iframeCadUsuario" name="frmCadUsuario" id="frmCadUsuario" method="post" enctype="multipart/form-data" class="SignupForm">
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
                        <input type="text" class="validate[required] tipS" title="Nome do usuário do sistema." name="nome" id="nome" title="Nome" value="<?php echo $usuario->nome; ?>" />
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                    <label>Senha Nova</label>
                    <div class="formRight">
                        <input type="password" class="tipS" title="Senha para acessar o sistema, coloque uma senha com letras e números." name="senha" id="senha" value="" />
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="formRow">
                    <label>E-mail:<span class="req">*</span></label>
                    <div class="formRight">
                        <input type="text" class="validate[required] tipS" name="email" id="email" title="Seu email, deve ser uma email válido." value="<?php echo $usuario->email; ?>" />
                    </div>
                    <div class="clear"></div>
                </div>
            </fieldset>
            <fieldset class="step">
                <h1>Imagem do usuário </h1>
                <?
                if ($usuario->img) {
                    if (file_exists("../sistema/" . $usuario->img)) {
                ?>
                        <div class="formRow">
                            <label>Imagem existente:</label>
                            <div class="formRight">
                                <img src="../sistema/<?php echo $usuario->img; ?>" width="100" />
                            </div>
                            <div class="clear"></div>
                        </div>
                <?
                    }
                }
                ?>
                <div class="formRow">
                    <label>Nova Imagem:</label>
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
                            <option value="1" <?php if ($usuario->status == "1") echo "selected"; ?>>Ativo</option>
                            <option value="0" <?php if ($usuario->status == "0") echo "selected"; ?>>Inativo</option>
                        </select>
                    </div>
                    <div class="clear"></div>
                </div>
                <?php if ($objSession2->get('tlAdmLoginNivel') == 1) { ?>
                    <div class="formRow">
                        <label>Nível:<span class="req">*</span></label>
                        <div class="formRight">
                            <select name="nivel" id="nivel" class="tipS" title="Administrator tem acesso as configurações do sistema, o nível usuário não tem acesso as configurações do sistema.">
                                <option value="1" <?php if ($usuario->nivel == "1") echo "selected"; ?>>Administrador</option>
                                <option value="0" <?php if ($usuario->nivel == "0") echo "selected"; ?>>Usuário</option>
                            </select>
                        </div>
                        <div class="clear"></div>
                    </div>
                <?
                } else {
                ?>
                    <div class="formRow">
                        <label>Nível:<span class="req">*</span></label>
                        <div class="formRight">
                            <select name="nivel" id="nivel" class="tipS" title="Apenas o nível usuário esta disponível.">
                                <option value="0" selected>Usuário</option>
                            </select>
                        </div>
                        <div class="clear"></div>
                    </div>
                <?
                }
                ?>
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
                    <?php if ($objSession2->get('tlAdmLoginNivel') == 1) { ?>
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
                    <?php } ?>

                    <tbody class="prachegar">
                        <?php if ($objSession2->get('tlAdmLoginNivel') == 1) { ?>
                            <?

                            if ($secoes_fixas["num"] > 0) {
                                $checkedf = array();
                                for ($i = 0; $i < $secoes_fixas["num"]; $i++) {

                                    //LAÇO PARA VERIFICAR SE O USU�?RIO ESTA CADASTRADO NA SEÇÃO[$i]
                                    for ($j = 0; $j < $secoes_fixas_usuario["num"]; $j++) {
                                        if ($secoes_fixas[$i]->id == $secoes_fixas_usuario[$j]->secao_fixa_id) {
                                            $checkedf[$i]['secao'] = "checked";
                                            if ($secoes_fixas_usuario[$j]->cadastrar == "1") {
                                                $checkedf[$i]['cadastrar'] = "checked";
                                            } else {
                                                $checkedf[$i]['cadastrar'] = "";
                                            }

                                            if ($secoes_fixas_usuario[$j]->alterar == "1") {
                                                $checkedf[$i]['alterar'] = "checked";
                                            } else {
                                                $checkedf[$i]['alterar'] = "";
                                            }

                                            if ($secoes_fixas_usuario[$j]->excluir == "1") {
                                                $checkedf[$i]['excluir'] = "checked";
                                            } else {
                                                $checkedf[$i]['excluir'] = "";
                                            }

                                            if ($secoes_fixas_usuario[$j]->publicar == "1") {
                                                $checkedf[$i]['publicar'] = "checked";
                                            } else {
                                                $checkedf[$i]['publicar'] = "";
                                            }
                                        }
                                    }
                            ?>
                                    <tr class="secoesParaChecar<?php echo $i ?>">
                                        <td><input name="secao_fixa[]" id="todosFixa<?php echo $i ?>" type="checkbox" onclick="selecionarTodosItensUsuario('<?php echo $i ?>')" value="<?php echo $secoes_fixas[$i]->id; ?>" <?php echo $checkedf[$i]['cadastrar']; ?> /></td>
                                        <td align="center"><?php echo $secoes_fixas[$i]->menu ?></td>
                                        <td><input type="checkbox" class="cadastrarFixa<?php echo $i ?>" name="cadastrar_fixa[<?php echo $secoes_fixas[$i]->id; ?>]" value="1" <?php echo $checkedf[$i]['cadastrar']; ?> /></td>
                                        <td><input type="checkbox" class="alterarFixa<?php echo $i ?>" name="alterar_fixa[<?php echo $secoes_fixas[$i]->id; ?>]" value="1" <?php echo $checkedf[$i]['alterar']; ?> /></td>
                                        <td><input type="checkbox" class="excluirFixa<?php echo $i ?>" name="excluir_fixa[<?php echo $secoes_fixas[$i]->id; ?>]" value="1" <?php echo $checkedf[$i]['excluir']; ?> /></td>
                                        <td><input type="checkbox" class="publicarFixa<?php echo $i ?>" name="publicar_fixa[<?php echo $secoes_fixas[$i]->id; ?>]" value="1" <?php echo $checkedf[$i]['publicar']; ?> /></td>
                                    </tr>
                            <?
                                }
                            }

                            ?>
                        <?php } ?>
                        <tr>
                            <td colspan="6">
                                <?php if ($permissao->alterar == "1") { ?>
                                    <input type="submit" class="button blackB" style="margin: 18px; float: right;" name="salvar" value="Salvar" onClick="$('#frmCadUsuario').submit();" />
                                <?php } ?>
                                <input type="hidden" name="id" id="id" value="<?php echo $usuario->id; ?>" />
                                <input type="hidden" name="imgAntiga" id="imgAntiga" value="<?php echo $usuario->img; ?>" />
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