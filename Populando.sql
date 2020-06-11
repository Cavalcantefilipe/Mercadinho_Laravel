
INSERT INTO `cliente` (`idCliente`, `nome`, `cpf/cnpj`, `dataCadastrado`) VALUES
(2, 'ANGELA ALVES DA SILVA', '98255416013', '2020-06-11 01:15:35'),
(3, 'HELLEN  ROCHA', '24166552058', '2020-06-11 01:16:17'),
(4, 'MARCIO PEREIRA NOBRE', '50469121041', '2020-06-11 01:17:29'),
(5, 'PEDRO MARIETTE', '34566618005', '2020-06-11 01:17:55'),
(6, 'BRENO ALVES GONÇALVES', '14147292003', '2020-06-11 01:18:33'),
(7, 'Rebeca Santos', '43493254091', '2020-06-11 01:28:55'),
(8, 'RAQUEL CAVALCANTE', '37466682472', '2020-06-11 01:29:54');

INSERT INTO `produto` (`idProduto`, `descricao`, `quantidade`, `preco`, `dataCadastrado`) VALUES
(1, 'OLÉO', 119, 3.85, '2020-06-11 01:20:22'),
(2, 'SABÃO EM PÓ OMO', 40, 8.2, '2020-06-11 01:21:06'),
(3, 'ARROZ', 60, 15.3, '2020-06-11 01:21:42'),
(4, 'FEIJÃO', 41, 8, '2020-06-11 01:22:22'),
(5, 'CAFÉ', 55, 9.22, '2020-06-11 01:24:27'),
(6, 'FARINHA', 25, 3.2, '2020-06-11 01:50:43');


INSERT INTO `venda` (`idVenda`, `total`, `idCliente`, `finalizado`) VALUES
(1, 37.59, 3, '2020-06-10 22:25:51'),
(2, 31.3, 2, '2020-06-10 23:53:17');
COMMIT;

INSERT INTO `itensvenda` (`idItemVenda`, `idVenda`, `idProduto`, `quantidadeProduto`, `valorProduto`) VALUES
(1, 1, 1, 1, 3.85),
(2, 1, 3, 1, 15.3),
(3, 1, 5, 2, 9.22),
(4, 2, 3, 1, 15.3),
(5, 2, 4, 2, 8);

