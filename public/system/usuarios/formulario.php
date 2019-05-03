<?php
$src = explode('/', $getexe);

$profile = (in_array('profile', $src) ? true : false);
?>

<form method="post" id="formPost" name="formPost">
    <input class="noclear" type="hidden" name="action" value="update">

    <!-- Nav tabs -->
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#home">Identificação</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#enderecos">Endereço</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#texto">Observação</a>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div class="tab-pane container active" id="home">
            <input type="hidden" class="j_id" name="id" value="<?= (isset($usuario)) ? $usuario->id : ''; ?>"/>

            <?php if (!$profile) : ?>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-12">
                            <label for="id_perfil">Perfil</label>
                            <select name="id_perfil" id="id_perfil" class="form-control">
                            </select>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="form-group">
                <div class="form-row">
                    <div class="col-10">
                        <label for="nome">Nome</label>
                        <input type="text" name="nome" id="nome" class="form-control"
                               value="<?= (isset($usuario)) ? $usuario->nome : ''; ?>" autofocus>
                    </div>

                    <?php if (!$profile) : ?>
                        <div class="col-2">
                            <label for="nome">Inativo</label>
                            <input type="checkbox" value="0" name="status" id="status"
                                   class="form-control">
                        </div>
                    <?php endif; ?>
                </div>
            </div>


            <div class="form-group">
                <div class="form-row">
                    <div class="col-12">
                        <label for="nome">E-mail</label>
                        <input type="email" name="email" id="email" class="form-control"
                               value="<?= (isset($usuario)) ? $usuario->email : ''; ?>">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="form-row">
                    <div class="col-12 col-sm-6">
                        <label for="nome">Telefone</label>
                        <input type="text" name="telefone" id="telefone" class="form-control"
                               value="<?= (isset($usuario)) ? $usuario->telefone : ''; ?>">
                    </div>

                    <div class="col-12 col-sm-6">
                        <label for="nome">Celular</label>
                        <input type="text" name="celular" id="celular" class="form-control"
                               value="<?= (isset($usuario)) ? $usuario->celular : ''; ?>">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="form-row">
                    <div class="col-12 col-sm-6">
                        <label for="nome">Senha</label>
                        <input type="password" name="senha" id="senha" class="form-control"
                               value="<?= (isset($usuario)) ? $usuario->senha : ''; ?>">
                    </div>
                </div>
            </div>


        </div>
        <div class="tab-pane container fade" id="enderecos">

            <div class="form-group">
                <div class="form-row">
                    <div class="col-12 col-sm-10">
                        <label for="endereco">Endereço</label>
                        <input type="text" name="endereco" id="endereco" class="form-control"
                               value="<?= (isset($usuario)) ? $usuario->endereco : ''; ?>">
                    </div>

                    <div class="col-12 col-sm-2">
                        <label for="numero">Número</label>
                        <input type="text" name="numero" id="numero" class="form-control"
                               value="<?= (isset($usuario)) ? $usuario->numero : ''; ?>">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="form-row">
                    <div class="col-12 col-sm-4">
                        <label for="bairro">Bairro</label>
                        <input type="text" name="bairro" id="bairro" class="form-control"
                               value="<?= (isset($usuario)) ? $usuario->bairro : ''; ?>">
                    </div>

                    <div class="col-12 col-sm-4">
                        <label for="cidade">Cidade</label>
                        <input type="text" name="cidade" id="cidade" class="form-control"
                               value="<?= (isset($usuario)) ? $usuario->cidade : ''; ?>">
                    </div>


                    <div class="col-12 col-sm-4">
                        <label for="estado">UF</label>

                        <select id="estado" name="estado" class="form-control">
                            <option value="AC" <?= (isset($usuario) && ($usuario->estado == 'AC')) ? 'selected' : ''; ?>>
                                Acre
                            </option>
                            <option value="AL" <?= (isset($usuario) && ($usuario->estado == 'AL')) ? 'selected' : ''; ?>>
                                Alagoas
                            </option>
                            <option value="AP" <?= (isset($usuario) && ($usuario->estado == 'AP')) ? 'selected' : ''; ?>>
                                Amapá
                            </option>
                            <option value="AM" <?= (isset($usuario) && ($usuario->estado == 'AM')) ? 'selected' : ''; ?>>
                                Amazonas
                            </option>
                            <option value="BA" <?= (isset($usuario) && ($usuario->estado == 'BA')) ? 'selected' : ''; ?>>
                                Bahia
                            </option>
                            <option value="CE" <?= (isset($usuario) && ($usuario->estado == 'CE')) ? 'selected' : ''; ?>>
                                Ceará
                            </option>
                            <option value="DF" <?= (isset($usuario) && ($usuario->estado == 'DF')) ? 'selected' : ''; ?>>
                                Distrito Federal
                            </option>
                            <option value="ES" <?= (isset($usuario) && ($usuario->estado == 'ES')) ? 'selected' : ''; ?>>
                                Espírito Santo
                            </option>
                            <option value="GO" <?= (isset($usuario) && ($usuario->estado == 'GO')) ? 'selected' : ''; ?>>
                                Goiás
                            </option>
                            <option value="MA" <?= (isset($usuario) && ($usuario->estado == 'MA')) ? 'selected' : ''; ?>>
                                Maranhão
                            </option>
                            <option value="MT" <?= (isset($usuario) && ($usuario->estado == 'MT')) ? 'selected' : ''; ?>>
                                Mato Grosso
                            </option>
                            <option value="MS" <?= (isset($usuario) && ($usuario->estado == 'MS')) ? 'selected' : ''; ?>>
                                Mato Grosso do Sul
                            </option>
                            <option value="MG" <?= (isset($usuario) && ($usuario->estado == 'MG')) ? 'selected' : ''; ?>>
                                Minas Gerais
                            </option>
                            <option value="PA" <?= (isset($usuario) && ($usuario->estado == 'PA')) ? 'selected' : ''; ?>>
                                Pará
                            </option>
                            <option value="PB" <?= (isset($usuario) && ($usuario->estado == 'PB')) ? 'selected' : ''; ?>>
                                Paraíba
                            </option>
                            <option value="PR" <?= (isset($usuario) && ($usuario->estado == 'PR')) ? 'selected' : ''; ?>>
                                Paraná
                            </option>
                            <option value="PE" <?= (isset($usuario) && ($usuario->estado == 'PE')) ? 'selected' : ''; ?>>
                                Pernambuco
                            </option>
                            <option value="PI" <?= (isset($usuario) && ($usuario->estado == 'PI')) ? 'selected' : ''; ?>>
                                Piauí
                            </option>
                            <option value="RJ" <?= (isset($usuario) && ($usuario->estado == 'RJ')) ? 'selected' : ''; ?>>
                                Rio de Janeiro
                            </option>
                            <option value="RN" <?= (isset($usuario) && ($usuario->estado == 'RN')) ? 'selected' : ''; ?>>
                                Rio Grande do Norte
                            </option>
                            <option value="RS" <?= (isset($usuario) && ($usuario->estado == 'RS')) ? 'selected' : ''; ?>>
                                Rio Grande do Sul
                            </option>
                            <option value="RO" <?= (isset($usuario) && ($usuario->estado == 'RO')) ? 'selected' : ''; ?>>
                                Rondônia
                            </option>
                            <option value="RR" <?= (isset($usuario) && ($usuario->estado == 'PR')) ? 'selected' : ''; ?>>
                                Roraima
                            </option>
                            <option value="SC" <?= (isset($usuario) && ($usuario->estado == 'SC')) ? 'selected' : ''; ?>>
                                Santa Catarina
                            </option>
                            <option value="SP" <?= (isset($usuario) && ($usuario->estado == 'SP')) ? 'selected' : ''; ?>>
                                São Paulo
                            </option>
                            <option value="SE" <?= (isset($usuario) && ($usuario->estado == 'SE')) ? 'selected' : ''; ?>>
                                Sergipe
                            </option>
                            <option value="TO" <?= (isset($usuario) && ($usuario->estado == 'TO')) ? 'selected' : ''; ?>>
                                Tocantins
                            </option>
                            <option value="EX" <?= (isset($usuario) && ($usuario->estado == 'EX')) ? 'selected' : ''; ?>>
                                Estrangeiro
                            </option>
                        </select>
                    </div>
                </div>
            </div>


            <div class="form-group">
                <div class="form-row">
                    <div class="col-12">
                        <label for="pais">País</label>
                        <input type="text" name="pais" id="pais" class="form-control"
                               value="<?= (isset($usuario)) ? $usuario->pais : ''; ?>">
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane container fade" id="texto">
            <div class="form-group">
                <label for="observacoes">Observações:</label>
                <textarea class="form-control" rows="5" id="observacoes"
                          name="observacoes"><?= (isset($usuario)) ? $usuario->observacoes : ''; ?></textarea>
            </div>
        </div>
    </div>

</form>